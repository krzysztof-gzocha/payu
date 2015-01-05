<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Configuration\Credentials;

use Team3\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;

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
    public function getAlgorithm();
}
