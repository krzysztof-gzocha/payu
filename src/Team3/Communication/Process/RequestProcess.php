<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication\Process;

use Buzz\Message\MessageInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Team3\Communication\ClientInterface;
use Team3\Communication\Request\PayURequestInterface;
use Team3\Communication\Response\ResponseInterface;
use Team3\Configuration\ConfigurationInterface;
use Team3\Order\Serializer\SerializableInterface;
use Team3\Order\Serializer\SerializerException;
use Team3\Order\Serializer\SerializerInterface;

/**
 * Class RequestProcess
 * @package Team3\Communication\Process
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class RequestProcess implements RequestProcessInterface
{
    /**
     * @var ResponseInterface[]
     */
    private $responses;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @param SerializerInterface $serializer
     * @param ClientInterface     $client
     * @param ValidatorInterface  $validator
     */
    public function __construct(
        SerializerInterface $serializer,
        ClientInterface $client,
        ValidatorInterface $validator
    ) {
        $this->responses = [];
        $this->serializer = $serializer;
        $this->client = $client;
        $this->validator = $validator;
        $this->shouldValidate = true;
    }

    /**
     * @param PayURequestInterface   $payURequest
     * @param ConfigurationInterface $configuration
     *
     * @return object
     */
    public function process(
        PayURequestInterface $payURequest,
        ConfigurationInterface $configuration
    ) {
        if ($this->shouldValidate) {
            $this->validate($payURequest->getDataObject());
        }

        $curlResponse = $this->client->sendRequest($configuration, $payURequest);

        return $this->deserializeRawResponse($curlResponse, $payURequest);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return $this
     */
    public function addResponse(ResponseInterface $response)
    {
        $this->responses[] = $response;

        return $this;
    }

    /**
     * @param ResponseInterface[] $responses
     *
     * @return $this
     */
    public function setResponses(array $responses)
    {
        $this->responses = $responses;

        return $this;
    }

    /**
     * @return $this
     */
    public function disableValidation()
    {
        $this->shouldValidate = false;

        return $this;
    }

    /**
     * @param SerializableInterface $object
     *
     * @throws InvalidRequestDataObjectException
     */
    private function validate(SerializableInterface $object)
    {
        $violations = $this->validator->validate($object);

        if (0 < $violations->count()) {
            throw new InvalidRequestDataObjectException(
                $violations,
                sprintf(
                    "Given object %s in PayU request is invalid. %d violations are in this exception.",
                    get_class($object),
                    $violations->count()
                )
            );
        }
    }

    /**
     * @param MessageInterface     $curlResponse
     * @param PayURequestInterface $payURequest
     *
     * @return object
     * @throws NoResponseObjectException
     * @throws RequestProcessException
     */
    private function deserializeRawResponse(
        MessageInterface $curlResponse,
        PayURequestInterface $payURequest
    ) {
        try {
            $deserialized = $this
                ->serializer
                ->fromJson(
                    $curlResponse->getContent(),
                    $this->getResponseClass($payURequest)
                );
        } catch (SerializerException $exception) {
            throw new RequestProcessException(
                sprintf(
                    'Exception %s was thrown during deserialization. Message: "%s"',
                    get_class($exception),
                    $exception->getMessage()
                ),
                $exception->getCode(),
                $exception
            );
        }

        return $deserialized;
    }

    /**
     * @param PayURequestInterface $payURequest
     *
     * @return string
     * @throws NoResponseObjectException
     */
    private function getResponseClass(
        PayURequestInterface $payURequest
    ) {
        foreach ($this->responses as $response) {
            if ($response->supports($payURequest)) {
                return get_class($response);
            }
        }

        throw new NoResponseObjectException(sprintf(
            'There is no response object that support %s request',
            get_class($payURequest)
        ));
    }
}
