<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication\Process;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Team3\Communication\ClientInterface;
use Team3\Communication\Process\ResponseDeserializer\ResponseDeserializerInterface;
use Team3\Communication\Request\PayURequestInterface;
use Team3\Communication\Response\ResponseInterface;
use Team3\Configuration\ConfigurationInterface;
use Team3\Serializer\SerializableInterface;

/**
 * Class RequestProcess
 * @package Team3\Communication\Process
 */
class RequestProcess implements RequestProcessInterface
{
    /**
     * @var ResponseDeserializerInterface
     */
    private $responseDeserializer;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var bool
     */
    private $shouldValidate;

    /**
     * @param ResponseDeserializerInterface $responseDeserializer
     * @param ClientInterface               $client
     * @param ValidatorInterface            $validator
     */
    public function __construct(
        ResponseDeserializerInterface $responseDeserializer,
        ClientInterface $client,
        ValidatorInterface $validator
    ) {
        $this->responseDeserializer = $responseDeserializer;
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

        return $this->responseDeserializer->deserializeResponse($curlResponse, $payURequest);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return $this
     */
    public function addResponse(ResponseInterface $response)
    {
        $this->responseDeserializer->addResponse($response);

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
}
