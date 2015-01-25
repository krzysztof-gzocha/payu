<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Process\ResponseDeserializer;

use Buzz\Message\MessageInterface;
use Team3\PayU\Communication\Process\RequestProcessException;
use Team3\PayU\Communication\Request\PayURequestInterface;
use Team3\PayU\Communication\Response\ResponseInterface;

interface ResponseDeserializerInterface
{
    /**
     * @param ResponseInterface $response
     *
     * @return $this
     */
    public function addResponse(ResponseInterface $response);

    /**
     * @param ResponseInterface[] $responses
     *
     * @return $this
     */
    public function setResponses(array $responses);

    /**
     * @param MessageInterface     $curlResponse
     * @param PayURequestInterface $payURequest
     *
     * @return object
     * @throws RequestProcessException
     */
    public function deserializeResponse(MessageInterface $curlResponse, PayURequestInterface $payURequest);
}
