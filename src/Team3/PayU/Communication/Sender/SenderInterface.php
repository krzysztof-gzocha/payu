<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Sender;

use Buzz\Message\RequestInterface;
use Buzz\Message\Response;
use Team3\PayU\Communication\ClientException as PayUClientException;
use Team3\PayU\Configuration\Credentials\CredentialsInterface;

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
