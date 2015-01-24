<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Communication\Process\ResponseDeserializer;

use Buzz\Message\MessageInterface;
use Team3\Communication\Process\RequestProcessException;
use Team3\Communication\Request\PayURequestInterface;
use Team3\Communication\Response\ResponseInterface;

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
