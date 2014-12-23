<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\SignatureCalculator;

use Team3\Configuration\Credentials\CredentialsInterface;
use Team3\Order\Model\OrderInterface;
use Team3\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;
use Team3\SignatureCalculator\Encoder\EncoderException;
use Team3\SignatureCalculator\Encoder\EncoderInterface;
use Team3\SignatureCalculator\ParametersSorter\ParametersSorterInterface;

class SignatureCalculator implements SignatureCalculatorInterface
{
    const SIGNATURE_FORMAT = 'signature=%s;algorithm=%s;sender=%s';

    /**
     * @var ParametersSorterInterface
     */
    private $parametersSorter;

    /**
     * @var EncoderInterface
     */
    private $encoder;

    /**
     * @var string
     */
    private $dataToEncrypt;

    /**
     * @param ParametersSorterInterface $parametersSorter
     * @param EncoderInterface          $encoder
     */
    public function __construct(
        ParametersSorterInterface $parametersSorter,
        EncoderInterface $encoder
    ) {
        $this->parametersSorter = $parametersSorter;
        $this->encoder = $encoder;
        $this->dataToEncrypt = '';
    }

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
    ) {
        return sprintf(
            self::SIGNATURE_FORMAT,
            $this->getSignature($order, $credentials, $algorithm),
            $algorithm->getName(),
            $credentials->getMerchantPosId()
        );
    }

    /**
     * @param OrderInterface       $order
     * @param CredentialsInterface $credentials
     * @param AlgorithmInterface   $algorithm
     *
     * @return string
     * @throws SignatureCalculatorException
     */
    private function getSignature(
        OrderInterface $order,
        CredentialsInterface $credentials,
        AlgorithmInterface $algorithm
    ) {
        // Concat sorted parameters
        $sortedParameters = $this->getSortedParameters($order);
        array_walk_recursive($sortedParameters, function ($value) {
            $this->dataToEncrypt .= $value;
        });

        // Add private key
        $dataToEncrypt = sprintf(
            '%s%s',
            $this->dataToEncrypt,
            $credentials->getPrivateKey()
        );
        $this->dataToEncrypt = '';

        try {
            return $this->encoder->encode($dataToEncrypt, $algorithm);
        } catch (EncoderException $exception) {
            throw new SignatureCalculatorException(
                $exception->getMessage(),
                $exception->getCode(),
                $exception
            );
        }
    }

    /**
     * @param OrderInterface $order
     *
     * @return array
     */
    private function getSortedParameters(OrderInterface $order)
    {
        return $this->parametersSorter->getSortedParameters($order);
    }
}
