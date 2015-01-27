<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Sender;

use Buzz\Client\ClientInterface;
use Buzz\Message\RequestInterface;
use Buzz\Message\Response;
use Psr\Log\LoggerInterface;
use Team3\PayU\Configuration\Credentials\CredentialsInterface;
use Team3\PayU\Communication\ClientException;

class Sender implements SenderInterface
{
    /**
     * @var ClientInterface
     */
    private $curlClient;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param ClientInterface $curlClient
     * @param LoggerInterface $logger
     */
    public function __construct(
        ClientInterface $curlClient,
        LoggerInterface $logger
    ) {
        $this->curlClient = $curlClient;
        $this->logger = $logger;
    }

    /**
     * @param RequestInterface     $request
     * @param CredentialsInterface $credentials
     *
     * @return Response
     * @throws ClientException
     */
    public function send(
        RequestInterface $request,
        CredentialsInterface $credentials
    ) {
        $response = new Response();

        try {
            $this
                ->curlClient
                ->send(
                    $request,
                    $response,
                    $this->getOptions($credentials)
                );
        } catch (\Exception $exception) {
            $this->logException($exception);
            throw new ClientException(
                sprintf(
                    'Exception %s occurred with message: "%s"',
                    get_class($exception),
                    $exception->getMessage()
                ),
                $exception->getCode(),
                $exception
            );
        }

        return $response;
    }

    /**
     * @param CredentialsInterface $credentials
     *
     * @return array
     */
    private function getOptions(CredentialsInterface $credentials)
    {
        return [
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => sprintf(
                '%s:%s',
                $credentials->getMerchantPosId(),
                $credentials->getMerchantPosId()
            ),
            CURLOPT_SSLVERSION => 1,
            CURLOPT_SSL_CIPHER_LIST => $credentials->getEncryptionProtocols(),
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => 'gzip',
            CURLOPT_FOLLOWLOCATION => false,
        ];
    }

    /**
     * @param \Exception $exception
     */
    private function logException(\Exception $exception)
    {
        $this
            ->logger
            ->error(sprintf(
                '%s was thrown with message %s',
                get_class($exception),
                $exception->getMessage()
            ));
    }
}
