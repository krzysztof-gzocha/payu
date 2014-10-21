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

    /**
     * @param string $protocol
     * @param string $domain
     * @param string $path
     * @param string $version
     */
    public function __construct(
        $protocol = 'https',
        $domain = 'payu.com',
        $path = 'api',
        $version = 'v2_1'
    ) {
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
}
