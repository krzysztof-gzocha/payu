<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\SignatureCalculator\Encoder;

use Team3\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;
use Team3\SignatureCalculator\Encoder\Strategy\EncoderStrategyInterface;

class Encoder implements EncoderInterface
{
    /**
     * @var EncoderStrategyInterface[]
     */
    private $strategies;

    public function __construct()
    {
        $this->strategies = [];
    }

    /**
     * @param string             $data
     * @param AlgorithmInterface $algorithm
     *
     * @return string
     * @throws EncoderException
     */
    public function encode($data, AlgorithmInterface $algorithm)
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($algorithm)) {
                return $strategy->encode($data);
            }
        }

        throw new EncoderException(sprintf(
            'None of encoder strategies supports algorithm "%s"',
            get_class($algorithm)
        ));
    }

    /**
     * @param EncoderStrategyInterface $strategy
     *
     * @return $this
     */
    public function addStrategy(EncoderStrategyInterface $strategy)
    {
        $this->strategies[] = $strategy;

        return $this;
    }
}
