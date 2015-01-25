<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\SignatureCalculator;

use Team3\PayU\Configuration\Credentials\CredentialsInterface;
use Team3\PayU\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;

interface SignatureCalculatorInterface
{
    /**
     * @param string[]             $data
     * @param CredentialsInterface $credentials
     * @param AlgorithmInterface   $algorithm
     *
     * @return string
     * @throws SignatureCalculatorException
     */
    public function calculate(
        array $data,
        CredentialsInterface $credentials,
        AlgorithmInterface $algorithm
    );
}
