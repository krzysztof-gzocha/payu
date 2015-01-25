<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\SignatureCalculator\Encoder\Algorithms;

abstract class AbstractAlgorithm implements AlgorithmInterface
{
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
