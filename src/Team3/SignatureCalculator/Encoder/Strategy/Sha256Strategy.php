<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\SignatureCalculator\Encoder\Strategy;

use Team3\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;
use Team3\SignatureCalculator\Encoder\Algorithms\Sha256Algorithm;
use Team3\SignatureCalculator\Encoder\EncoderException;

class Sha256Strategy implements EncoderStrategyInterface
{
    /**
     * @param AlgorithmInterface $algorithm
     *
     * @return bool
     */
    public function supports(AlgorithmInterface $algorithm)
    {
        return $algorithm instanceof Sha256Algorithm;
    }

    /**
     * @param string $data
     *
     * @return string
     * @throws EncoderException
     */
    public function encode($data)
    {
        if (!function_exists('hash')) {
            throw new EncoderException(
                'There is no hash function defined. Could not encode data.'
            );
        }

        return hash('sha256', $data);
    }
}
