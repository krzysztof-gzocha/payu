<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication\CurlRequestBuilder;

use Buzz\Message\Request;
use Buzz\Message\RequestInterface as CurlRequestInterface;
use Team3\Communication\Request\PayURequestInterface;
use Team3\Configuration\ConfigurationInterface;

class CurlRequestBuilder implements CurlRequestBuilderInterface
{
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
        $curlRequest->setContent($request->getData());
        $curlRequest->setHost($configuration->getDomain());
        $curlRequest->setResource($request->getPath());
        $curlRequest->setMethod(CurlRequestInterface::METHOD_POST);

        return $curlRequest;
    }
}
