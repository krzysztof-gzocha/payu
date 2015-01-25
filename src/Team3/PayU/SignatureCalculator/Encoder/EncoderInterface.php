<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\SignatureCalculator\Encoder;

use Team3\PayU\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;

interface EncoderInterface
{
    /**
     * @param string             $data
     * @param AlgorithmInterface $algorithm
     *
     * @return string
     * @throws EncoderException
     */
    public function encode($data, AlgorithmInterface $algorithm);
}
