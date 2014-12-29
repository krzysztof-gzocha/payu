<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\SignatureCalculator\Encoder;

use Psr\Log\LoggerInterface;
use Team3\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;
use Team3\SignatureCalculator\Encoder\Strategy\EncoderStrategyInterface;

class Encoder implements EncoderInterface
{
    /**
     * @var EncoderStrategyInterface[]
     */
    private $strategies;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->strategies = [];
        $this->logger = $logger;
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
                $result = $strategy->encode($data);
                $this->logEncoderResult($strategy, $algorithm, $data, $result);

                return $result;
            }
        }

        $this->throwNoStrategiesException($algorithm);
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

    /**
     * @param EncoderStrategyInterface $encoderStrategy
     * @param AlgorithmInterface       $algorithm
     * @param string                   $inputData
     * @param string                   $encoderResult
     */
    private function logEncoderResult(
        EncoderStrategyInterface $encoderStrategy,
        AlgorithmInterface $algorithm,
        $inputData,
        $encoderResult
    ) {
        $this
            ->logger
            ->debug(sprintf(
                'Encoder\'s strategy %s (algorithm: %s) successfully encode data "%s" into "%s"',
                get_class($encoderStrategy),
                get_class($algorithm),
                $inputData,
                $encoderResult
            ));
    }

    /**
     * @param AlgorithmInterface $algorithm
     *
     * @throws EncoderException
     */
    private function throwNoStrategiesException(AlgorithmInterface $algorithm)
    {
        $message = sprintf(
            'None of encoder strategies supports algorithm "%s"',
            get_class($algorithm)
        );
        $this
            ->logger
            ->error($message);

        throw new EncoderException($message);
    }
}
