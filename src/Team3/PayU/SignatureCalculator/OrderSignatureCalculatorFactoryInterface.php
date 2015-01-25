<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\SignatureCalculator;

use Psr\Log\LoggerInterface;

interface OrderSignatureCalculatorFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return OrderSignatureCalculatorInterface
     */
    public function build(LoggerInterface $logger);
}
