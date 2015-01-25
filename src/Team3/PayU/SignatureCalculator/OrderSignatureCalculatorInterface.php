<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\SignatureCalculator;

use Team3\PayU\Configuration\Credentials\CredentialsInterface;
use Team3\PayU\Order\Model\OrderInterface;
use Team3\PayU\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;

interface OrderSignatureCalculatorInterface
{
    /**
     * @param OrderInterface       $order
     * @param CredentialsInterface $credentials
     * @param AlgorithmInterface   $algorithm
     *
     * @return string
     * @throws SignatureCalculatorException
     */
    public function calculate(
        OrderInterface $order,
        CredentialsInterface $credentials,
        AlgorithmInterface $algorithm
    );
}
