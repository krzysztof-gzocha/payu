<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Configuration\Credentials;

use Team3\PayU\SignatureCalculator\Encoder\Algorithms\Md5Algorithm;

/**
 * {@inheritdoc}
 *
 * Will return sandbox credentials, MD5 algorithm for signature calculations
 * and TLSv1 as encryption protocol
 *
 * Class TestCredentials
 * @package Team3\PayU\Configuration\Credentials
 */
class TestCredentials extends Credentials
{
    const MERCHANT_POS_ID = '145227';
    const PRIVATE_KEY = '13a980d4f851f3d9a1cfc792fb1f5e50';

    public function __construct()
    {
        $this->signatureAlgorithm = new Md5Algorithm();
        $this->encryptionProtocols = 'TLSv1';
    }

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
