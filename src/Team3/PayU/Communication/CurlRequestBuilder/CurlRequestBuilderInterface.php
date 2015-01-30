<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\CurlRequestBuilder;

use Buzz\Message\Request;
use Team3\PayU\Communication\Request\PayURequestInterface;
use Team3\PayU\Configuration\ConfigurationInterface;

/**
 * This library is using two types of request. First type is {@link PayuRequestInterface}
 * and second is {@link \Buzz\Message\Request}. Responsibility of this class is to transform
 * simple {@link PayURequestInterface} into {@link \Buzz\Message\Request} with given
 * {@link ConfigurationInterface}
 *
 * Interface CurlRequestBuilderInterface
 * @package Team3\PayU\Communication\CurlRequestBuilder
 */
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
