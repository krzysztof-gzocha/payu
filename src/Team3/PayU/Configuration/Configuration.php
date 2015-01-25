<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\Configuration;

use Team3\PayU\Configuration\Credentials\CredentialsInterface;

/**
 * PayU API basic configuration
 * @package Team3\PayU\Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @var string
     */
    protected $protocol;

    /**
     * @var string
     */
    protected $domain;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var CredentialsInterface
     */
    protected $credentials;

    /**
     * @param CredentialsInterface $credentials
     * @param string               $protocol
     * @param string               $domain
     * @param string               $path
     * @param string               $version
     */
    public function __construct(
        CredentialsInterface $credentials,
        $protocol = 'https',
        $domain = 'secure.payu.com',
        $path = 'api',
        $version = 'v2_1'
    ) {
        $this->credentials = $credentials;
        $this->protocol = $protocol;
        $this->domain = $domain;
        $this->path = $path;
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function getAPIUrl()
    {
        return sprintf(
            '%s://%s/%s/%s',
            $this->getProtocol(),
            $this->getDomain(),
            $this->getPath(),
            $this->getVersion()
        );
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return CredentialsInterface
     */
    public function getCredentials()
    {
        return $this->credentials;
    }
}
