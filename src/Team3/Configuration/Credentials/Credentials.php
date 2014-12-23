<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Configuration\Credentials;

class Credentials implements CredentialsInterface
{
    /**
     * @var string
     */
    private $merchantPosId;

    /**
     * @var string
     */
    private $privateKey;

    /**
     * @param string $merchantPosId
     * @param string $privateKey
     */
    public function __construct($merchantPosId, $privateKey)
    {
        $this->merchantPosId = $merchantPosId;
        $this->privateKey = $privateKey;
    }

    /**
     * @return string
     */
    public function getMerchantPosId()
    {
        return $this->merchantPosId;
    }

    /**
     * @return string
     */
    public function getPrivateKey()
    {
        return $this->privateKey;
    }
}
