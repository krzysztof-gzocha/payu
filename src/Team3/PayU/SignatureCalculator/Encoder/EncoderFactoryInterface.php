<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\SignatureCalculator\Encoder;

use Psr\Log\LoggerInterface;
use Team3\PayU\SignatureCalculator\Encoder\Strategy\EncoderStrategyInterface;

interface EncoderFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return EncoderInterface
     */
    public function build(LoggerInterface $logger);

    /**
     * @return EncoderStrategyInterface
     */
    public function getStrategies();
}
