<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Communication\CurlRequestBuilder;

use Buzz\Message\Request;
use Team3\Communication\Request\PayURequestInterface;
use Team3\Configuration\ConfigurationInterface;

interface CurlRequestBuilderInterface
{
    /**
     * @param ConfigurationInterface $configuration
     * @param PayURequestInterface   $request
     *
     * @return Request
     */
    public function build(ConfigurationInterface $configuration, PayURequestInterface $request);
}
