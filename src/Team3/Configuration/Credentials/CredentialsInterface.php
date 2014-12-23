<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Configuration\Credentials;

interface CredentialsInterface
{
    /**
     * @return string
     */
    public function getMerchantPosId();

    /**
     * @return string
     */
    public function getPrivateKey();
}
