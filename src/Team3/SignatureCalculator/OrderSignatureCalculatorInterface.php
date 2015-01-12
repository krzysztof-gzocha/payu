<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\SignatureCalculator;

use Team3\Configuration\Credentials\CredentialsInterface;
use Team3\Order\Model\OrderInterface;
use Team3\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;

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
