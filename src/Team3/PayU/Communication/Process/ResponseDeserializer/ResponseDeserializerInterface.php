<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Process\ResponseDeserializer;

use Buzz\Message\MessageInterface;
use Team3\PayU\Communication\Process\RequestProcessException;
use Team3\PayU\Communication\Request\PayURequestInterface;

/**
 * This class will deserialize response content into concrete object.
 * Possible returned objects should be located in {@link Team3\PayU\Communication\Response}
 *
 * Interface ResponseDeserializerInterface
 * @package Team3\PayU\Communication\Process\ResponseDeserializer
 */
interface ResponseDeserializerInterface
{
    /**
     * @param MessageInterface     $curlResponse
     * @param PayURequestInterface $payURequest
     *
     * @return object
     * @throws RequestProcessException
     */
    public function deserializeResponse(MessageInterface $curlResponse, PayURequestInterface $payURequest);
}
