<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication\Process;

use Buzz\Message\MessageInterface;
use Team3\Communication\ClientInterface;
use Team3\Communication\Request\PayURequestInterface;
use Team3\Communication\Response\ResponseInterface;
use Team3\Configuration\ConfigurationInterface;
use Team3\Order\Serializer\SerializerException;
use Team3\Order\Serializer\SerializerInterface;

class RequestProcess implements RequestProcessInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var ResponseInterface[]
     */
    private $responses;

    /**
     * @param SerializerInterface $serializer
     * @param ClientInterface     $client
     */
    public function __construct(
        SerializerInterface $serializer,
        ClientInterface $client
    ) {
        $this->serializer = $serializer;
        $this->client = $client;
        $this->responses = [];
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
