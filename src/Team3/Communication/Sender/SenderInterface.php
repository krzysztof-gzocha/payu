<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Communication\Sender;

use Buzz\Message\RequestInterface;
use Buzz\Message\Response;
use Team3\Communication\ClientException as PayUClientException;
use Team3\Configuration\Credentials\CredentialsInterface;

interface SenderInterface
{
    /**
     * @param RequestInterface     $request
     * @param CredentialsInterface $credentials
     *
     * @return Response
     * @throws PayUClientException
     */
    public function send(RequestInterface $request, CredentialsInterface $credentials);
}
