<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\SignatureCalculator;

use Team3\PayU\Configuration\Credentials\CredentialsInterface;
use Team3\PayU\Order\Model\OrderInterface;
use Team3\PayU\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;

/**
 * Will do the same job as {@link SignatureCalculatorInterface}
 * but doesn't need data as array. It will turn {@link OrderInterface}
 * array of alphabetical sorted parameters and pass it to signature calculator.
 *
 * Interface OrderSignatureCalculatorInterface
 * @package Team3\PayU\SignatureCalculator
 */
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
