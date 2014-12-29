<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication;

use Buzz\Client\ClientInterface;
use Team3\Communication\ClientInterface as PayUClientInterface;
use Buzz\Exception\ClientException;
use Buzz\Message\RequestInterface;
use Buzz\Message\Response;
use Psr\Log\LoggerInterface;
use Team3\Communication\ClientException as PayUClientException;
use Team3\Communication\CurlRequestBuilder\CurlRequestBuilderInterface;
use Team3\Communication\Request\PayURequestInterface;
use Team3\Configuration\ConfigurationInterface;

class Client implements PayUClientInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var CurlRequestBuilderInterface
     */
    private $requestBuilder;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param ClientInterface             $client
     * @param CurlRequestBuilderInterface $requestBuilder
     * @param LoggerInterface             $logger
     */
    public function __construct(
        ClientInterface $client,
        CurlRequestBuilderInterface $requestBuilder,
        LoggerInterface $logger
    ) {
        $this->client = $client;
        $this->requestBuilder = $requestBuilder;
        $this->logger = $logger;
    }

    /**
     * @param ConfigurationInterface $configuration
     * @param PayURequestInterface   $request
     *
     * @return Response
     * @throws ClientException
     */
    public function sendRequest(
        ConfigurationInterface $configuration,
        PayURequestInterface $request
    ) {
        $curlRequest = $this->requestBuilder->build($configuration, $request);
        $response = $this->send($curlRequest);

        $this
            ->logger
            ->debug(sprintf(
                'Request to %s/%s with content "%s" was send and response with content "%s" received',
                $curlRequest->getHost(),
                $curlRequest->getResource(),
                $curlRequest->getContent(),
                $response->getContent()
            ));

        return $response;
    }

    /**
     * @param RequestInterface $request
     *
     * @return Response
     * @throws PayUClientException
     */
    private function send(RequestInterface $request)
    {
        $response = new Response();

        try {
            $this
                ->client
                ->send(
                    $request,
                    $response
                );
        } catch (\Exception $exception) {
            $this->logException($exception);
            throw new PayUClientException(
                $exception->getMessage(),
                $exception->getCode(),
                $exception
            );
        }

        return $response;
    }

    /**
     * @param \Exception $exception
     */
    private function logException(\Exception $exception)
    {
        $this
            ->logger
            ->error(sprintf(
                '%s was thrown with message %s',
                get_class($exception),
                $exception->getMessage()
            ));
    }
}
