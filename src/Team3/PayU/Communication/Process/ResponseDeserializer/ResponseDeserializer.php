<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Process\ResponseDeserializer;

use Buzz\Message\MessageInterface;
use Team3\PayU\Communication\Process\RequestProcessException;
use Team3\PayU\Communication\Request\PayURequestInterface;
use Team3\PayU\Communication\Response\ResponseInterface;
use Team3\PayU\Serializer\SerializerException;
use Team3\PayU\Serializer\SerializerInterface;

/**
 * {@inheritdoc}
 */
class ResponseDeserializer implements ResponseDeserializerInterface
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
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->responses = [];
        $this->serializer = $serializer;
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
     * @param MessageInterface     $curlResponse
     * @param PayURequestInterface $payURequest
     *
     * @return ResponseInterface
     * @throws NoResponseFoundException
     */
    public function deserializeResponse(
        MessageInterface $curlResponse,
        PayURequestInterface $payURequest
    ) {
        return $this
            ->deserialize(
                $curlResponse,
                $this->getResponseClass($payURequest)
            );
    }

    /**
     * @param PayURequestInterface $payURequest
     *
     * @return string
     * @throws NoResponseFoundException
     */
    private function getResponseClass(
        PayURequestInterface $payURequest
    ) {
        foreach ($this->responses as $response) {
            if ($response->supports($payURequest)) {
                return get_class($response);
            }
        }

        throw new NoResponseFoundException(sprintf(
            'No response class that supports %s was found',
            get_class($payURequest)
        ));
    }

    /**
     * @param MessageInterface $curlResponse
     * @param string           $responseClass
     *
     * @return object
     * @throws RequestProcessException
     */
    private function deserialize(
        MessageInterface $curlResponse,
        $responseClass
    ) {
        try {
            return $this
                ->serializer
                ->fromJson(
                    $curlResponse->getContent(),
                    $responseClass
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
    }
}
