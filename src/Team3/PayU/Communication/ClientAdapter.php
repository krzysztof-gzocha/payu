<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication;

use Buzz\Client\ClientInterface;
use Buzz\Message\RequestInterface;
use Team3\PayU\Communication\ClientInterface as PayUClientInterface;
use Buzz\Exception\ClientException;
use Buzz\Message\Response;
use Psr\Log\LoggerInterface;
use Team3\PayU\Communication\CurlRequestBuilder\CurlRequestBuilderInterface;
use Team3\PayU\Communication\Request\PayURequestInterface;
use Team3\PayU\Communication\Sender\Sender;
use Team3\PayU\Communication\Sender\SenderInterface;
use Team3\PayU\Configuration\ConfigurationInterface;

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
     * @param Response         $response
     */
    private function logResponse(
        RequestInterface $request,
        Response $response
    ) {
        $this
            ->logger
            ->debug(sprintf(
                'Request to %s%s with content "%s" was send and response with content "%s" and status %d received',
                $request->getHost(),
                $request->getResource(),
                $request->getContent(),
                $response->getContent(),
                $response->getStatusCode()
            ));
    }
}
