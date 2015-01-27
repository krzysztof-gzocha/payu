<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\SignatureCalculator\Encoder\Strategy;

use Team3\PayU\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;

interface EncoderStrategyInterface
{
    /**
     * @param AlgorithmInterface $algorithm
     *
     * @return bool
     */
    public function supports(AlgorithmInterface $algorithm);

    /**
     * @param string $data
     *
     * @return string
     */
    public function encode($data);
}
