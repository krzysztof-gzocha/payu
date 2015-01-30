<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\SignatureCalculator;

use Team3\PayU\Configuration\Credentials\CredentialsInterface;
use Team3\PayU\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;
use Team3\PayU\SignatureCalculator\Encoder\EncoderException;
use Team3\PayU\SignatureCalculator\Encoder\EncoderInterface;

/**
 * {@inheritdoc}
 *
 * Class SignatureCalculator
 * @package Team3\PayU\SignatureCalculator
 */
class SignatureCalculator implements SignatureCalculatorInterface
{
    /**
     * @var EncoderInterface
     */
    private $encoder;

    /**
     * @param EncoderInterface $encoder
     */
    public function __construct(EncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * Calculates signature for any data given as an array of strings.
     *
     * @param string[]             $data
     * @param CredentialsInterface $credentials private key is needed to calculate signature
     * @param AlgorithmInterface   $algorithm   calculator uses encoder which can use multiple algorithms
     *
     * @return string
     * @throws SignatureCalculatorException
     */
    public function calculate(
        array $data,
        CredentialsInterface $credentials,
        AlgorithmInterface $algorithm
    ) {
        $concatenated = '';
        array_walk_recursive($data, function ($value) use (&$concatenated) {
            $concatenated .= $value;
        });
        $concatenated .= $credentials->getPrivateKey();

        return $this->encode($concatenated, $algorithm);
    }

    /**
     * Encode single string with given algorithm.
     *
     * @param string             $data
     * @param AlgorithmInterface $algorithm
     *
     * @return string
     * @throws SignatureCalculatorException
     */
    private function encode($data, AlgorithmInterface $algorithm)
    {
        try {
            $encodedData = $this->encoder->encode($data, $algorithm);
        } catch (EncoderException $exception) {
            throw new SignatureCalculatorException(
                $exception->getMessage(),
                $exception->getCode(),
                $exception
            );
        }

        return $encodedData;
    }
}
