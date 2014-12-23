<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\SignatureCalculator\Encoder\Algorithms;

interface AlgorithmInterface
{
    /**
     * @return string
     */
    public function getName();
}
