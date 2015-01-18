<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Configuration\Credentials;

use Team3\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;
use Team3\SignatureCalculator\Encoder\Algorithms\Md5Algorithm;

class Credentials implements CredentialsInterface
{
    /**
     * @var string
     */
    protected $merchantPosId;

    /**
     * @var string
     */
    protected $privateKey;

    /**
     * @var AlgorithmInterface
     */
    protected $signatureAlgorithm;

    /**
     * Used to specify CURLOPT_SSL_CIPHER_LIST cURL option
     * @var string
     */
    protected $encryptionProtocols;

    /**
     * @param string             $merchantPosId
     * @param string             $privateKey
     * @param AlgorithmInterface $signatureAlgorithm
     * @param string             $encryptionProtocols
     */
    public function __construct(
        $merchantPosId,
        $privateKey,
        AlgorithmInterface $signatureAlgorithm = null,
        $encryptionProtocols = 'TLSv1'
    ) {
        $this->merchantPosId = $merchantPosId;
        $this->privateKey = $privateKey;

        if (null === $signatureAlgorithm) {
            $signatureAlgorithm = new Md5Algorithm();
        }

        $this->signatureAlgorithm = $signatureAlgorithm;
        $this->encryptionProtocols = $encryptionProtocols;
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

    /**
     * @return AlgorithmInterface
     */
    public function getSignatureAlgorithm()
    {
        return $this->signatureAlgorithm;
    }

    /**
     * @return string
     */
    public function getEncryptionProtocols()
    {
        return $this->encryptionProtocols;
    }
}
