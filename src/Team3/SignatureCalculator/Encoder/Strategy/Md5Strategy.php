<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\SignatureCalculator\Encoder\Strategy;

use Team3\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;
use Team3\SignatureCalculator\Encoder\Algorithms\Md5Algorithm;

class Md5Strategy implements EncoderStrategyInterface
{
    /**
     * @param AlgorithmInterface $algorithm
     *
     * @return bool
     */
    public function supports(AlgorithmInterface $algorithm)
    {
        return $algorithm instanceof Md5Algorithm;
    }

    /**
     * @param string $data
     *
     * @return string
     */
    public function encode($data)
    {
        return md5($data);
    }
}
