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
    protected $protectedKey;

    /**
     * @var AlgorithmInterface
     */
    protected $algorithm;

    /**
     * @param string             $merchantPosId
     * @param string             $privateKey
     * @param AlgorithmInterface $algorithm
     */
    public function __construct(
        $merchantPosId,
        $privateKey,
        AlgorithmInterface $algorithm = null
    ) {
        $this->merchantPosId = $merchantPosId;
        $this->privateKey = $privateKey;

        if (null === $algorithm) {
            $algorithm = new Md5Algorithm();
        }

        $this->algorithm = $algorithm;
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
    public function getAlgorithm()
    {
        return $this->algorithm;
    }
}
