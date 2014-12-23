<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Configuration;

use Team3\Configuration\Credentials\CredentialsInterface;

/**
 * PayU API basic configuration
 * @package Team3\Configuration
 */
interface ConfigurationInterface
{
    /**
     * @return string
     */
    public function getDomain();

    /**
     * @return string
     */
    public function getPath();

    /**
     * @return string
     */
    public function getProtocol();

    /**
     * @return string
     */
    public function getVersion();

    /**
     * @return string
     */
    public function getAPIUrl();

    /**
     * @return CredentialsInterface
     */
    public function getCredentials();
}
