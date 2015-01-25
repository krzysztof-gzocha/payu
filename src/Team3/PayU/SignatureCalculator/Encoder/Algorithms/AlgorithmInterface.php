<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\SignatureCalculator\Encoder\Algorithms;

interface AlgorithmInterface
{
    /**
     * @return string
     */
    public function getName();
}
