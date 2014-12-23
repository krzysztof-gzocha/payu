<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\SignatureCalculator\Encoder\Strategy;

use Team3\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;
use Team3\SignatureCalculator\Encoder\Algorithms\Sha1Algorithm;

class Sha1Strategy implements EncoderStrategyInterface
{
    /**
     * @param AlgorithmInterface $algorithm
     *
     * @return bool
     */
    public function supports(AlgorithmInterface $algorithm)
    {
        return $algorithm instanceof Sha1Algorithm;
    }

    /**
     * @param string $data
     *
     * @return string
     */
    public function encode($data)
    {
        return sha1($data);
    }
}
