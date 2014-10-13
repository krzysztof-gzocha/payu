<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Configuration;

/**
 * PayU API basic configuration
 * @package Team3\Configuration
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

    public function __construct()
    {
        $this->protocol = 'https';
        $this->domain = 'payu.com';;
        $this->path = 'api';
        $this->version = 'v2_1';
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
     * @param string $domain
     *
     * @return Configuration
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     *
     * @return Configuration
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @param string $protocol
     *
     * @return Configuration
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return Configuration
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}
