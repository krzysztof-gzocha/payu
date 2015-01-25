<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Configuration\Credentials;

use Team3\PayU\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;

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

    /**
     * @return AlgorithmInterface
     */
    public function getSignatureAlgorithm();

    /**
     * @return string
     */
    public function getEncryptionProtocols();
}
