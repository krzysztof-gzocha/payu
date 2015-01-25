<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\Communication\CurlRequestBuilder;

use Buzz\Message\Request;
use Team3\PayU\Communication\Request\PayURequestInterface;
use Team3\PayU\Configuration\ConfigurationInterface;
use Team3\PayU\Serializer\SerializerInterface;

class CurlRequestBuilder implements CurlRequestBuilderInterface
{
    const CONTENT_TYPE = 'application/json';

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param ConfigurationInterface $configuration
     * @param PayURequestInterface   $request
     *
     * @return Request
     */
    public function build(
        ConfigurationInterface $configuration,
        PayURequestInterface $request
    ) {
        $curlRequest = new Request();

        if (PayURequestInterface::METHOD_POST === $request->getMethod()) {
            $curlRequest->setContent(
                $this->serializer->toJson($request->getDataObject())
            );
        }

        $curlRequest->setHost(sprintf(
            '%s://%s/',
            $configuration->getProtocol(),
            $configuration->getDomain()
        ));
        $curlRequest->setResource(sprintf(
            '%s/%s/%s',
            $configuration->getPath(),
            $configuration->getVersion(),
            $request->getPath()
        ));
        $curlRequest->setMethod($request->getMethod());
        $this->addHeaders($curlRequest, $configuration);

        return $curlRequest;
    }

    /**
     * @param Request                $curlRequest
     * @param ConfigurationInterface $configuration
     */
    private function addHeaders(
        Request $curlRequest,
        ConfigurationInterface $configuration
    ) {
        $authorization = sprintf(
            'Basic %s',
            base64_encode(
                sprintf(
                    '%s:%s',
                    $configuration->getCredentials()->getMerchantPosId(),
                    $configuration->getCredentials()->getPrivateKey()
                )
            )
        );
        $curlRequest->addHeaders([
            'Authorization' => $authorization,
            'Content-Type' => self::CONTENT_TYPE,
            'Accept' => self::CONTENT_TYPE,
        ]);
    }
}
