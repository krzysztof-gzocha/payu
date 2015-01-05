<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication\Process\ResponseDeserializer;

use Buzz\Message\MessageInterface;
use Team3\Communication\Process\RequestProcessException;
use Team3\Communication\Request\PayURequestInterface;
use Team3\Communication\Response\ResponseInterface;
use Team3\Order\Serializer\SerializerException;
use Team3\Order\Serializer\SerializerInterface;

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
     * @return object
     * @throws NoResponseObjectException
     * @throws RequestProcessException
     */
    public function deserializeResponse(
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
