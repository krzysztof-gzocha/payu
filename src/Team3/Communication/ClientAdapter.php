<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication;

use Buzz\Client\ClientInterface;
use Buzz\Message\MessageInterface;
use Buzz\Message\RequestInterface;
use Team3\Communication\ClientInterface as PayUClientInterface;
use Buzz\Exception\ClientException;
use Buzz\Message\Response;
use Psr\Log\LoggerInterface;
use Team3\Communication\CurlRequestBuilder\CurlRequestBuilderInterface;
use Team3\Communication\Request\PayURequestInterface;
use Team3\Communication\Sender\Sender;
use Team3\Communication\Sender\SenderInterface;
use Team3\Configuration\ConfigurationInterface;

class ClientAdapter implements PayUClientInterface
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
     * @var SenderInterface
     */
    private $sender;

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

        $this->sender = new Sender($this->client, $this->logger);
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
        $this->logRequest($curlRequest);
        $response = $this->sender->send($curlRequest, $configuration->getCredentials());
        $this->logResponse($curlRequest, $response);

        return $response;
    }

    /**
     * @param RequestInterface $request
     */
    private function logRequest(RequestInterface $request)
    {
        $this
            ->logger
            ->debug(sprintf(
                'Sending request to host:%s resource:%s with content "%s"',
                $request->getHost(),
                $request->getResource(),
                $request->getContent()
            ));
    }

    /**
     * @param RequestInterface $request
     * @param MessageInterface $response
     */
    private function logResponse(
        RequestInterface $request,
        MessageInterface $response
    ) {
        $this
            ->logger
            ->debug(sprintf(
                'Request to %s%s with content "%s" was send and response with content "%s" received',
                $request->getHost(),
                $request->getResource(),
                $request->getContent(),
                $response->getContent()
            ));
    }
}