<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication;

use Buzz\Exception\ClientException;
use Buzz\Message\Response;
use Team3\PayU\Communication\Request\PayURequestInterface;
use Team3\PayU\Configuration\ConfigurationInterface;

/**
 * Will build proper cURL request from {@link PayURequestInterface}
 * and send it via {@link SenderInterface}
 *
 * Interface ClientInterface
 * @package Team3\PayU\Communication
 */
interface ClientInterface
{
    /**
     * @param ConfigurationInterface $configuration
     * @param PayURequestInterface   $request
     *
     * @return Response
     * @throws ClientException
     */
    public function sendRequest(ConfigurationInterface $configuration, PayURequestInterface $request);
}
