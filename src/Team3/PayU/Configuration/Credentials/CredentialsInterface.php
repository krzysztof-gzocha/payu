<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Configuration\Credentials;

use Team3\PayU\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;

/**
 * Encapsulates credentials, signature calculating algorithm {@link AlgorithmInterface}
 * and encryption protocol.
 *
 * Interface CredentialsInterface
 * @package Team3\PayU\Configuration\Credentials
 */
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
