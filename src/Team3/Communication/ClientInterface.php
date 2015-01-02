<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Communication;

use Buzz\Exception\ClientException;
use Buzz\Message\Response;
use Team3\Communication\Request\PayURequestInterface;
use Team3\Configuration\ConfigurationInterface;

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
