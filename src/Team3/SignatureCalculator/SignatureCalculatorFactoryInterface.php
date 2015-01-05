<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\SignatureCalculator;

use Psr\Log\LoggerInterface;

interface SignatureCalculatorFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return SignatureCalculatorInterface
     */
    public function build(LoggerInterface $logger);
}
