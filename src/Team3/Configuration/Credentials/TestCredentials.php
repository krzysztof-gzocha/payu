<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Configuration\Credentials;

class TestCredentials implements CredentialsInterface
{
    const MERCHANT_POS_ID = '145227';
    const PRIVATE_KEY = '13a980d4f851f3d9a1cfc792fb1f5e50';

    /**
     * @return string
     */
    public function getMerchantPosId()
    {
        return self::MERCHANT_POS_ID;
    }

    /**
     * @return string
     */
    public function getPrivateKey()
    {
        return self::PRIVATE_KEY;
    }
}
