<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\SignatureCalculator;

use Psr\Log\LoggerInterface;
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
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param ParametersSorterInterface $parametersSorter
     * @param EncoderInterface          $encoder
     * @param LoggerInterface           $logger
     */
    public function __construct(
        ParametersSorterInterface $parametersSorter,
        EncoderInterface $encoder,
        LoggerInterface $logger
    ) {
        $this->parametersSorter = $parametersSorter;
        $this->encoder = $encoder;
        $this->logger = $logger;
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
        $signature = sprintf(
            self::SIGNATURE_FORMAT,
            $this->getSignature($order, $credentials, $algorithm),
            $algorithm->getName(),
            $credentials->getMerchantPosId()
        );
        $this->logCalculatedSignature($order, $signature);

        return $signature;
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

        return $this->encode($dataToEncrypt, $algorithm);
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

    /**
     * @param OrderInterface $order
     * @param string         $signature
     */
    private function logCalculatedSignature(OrderInterface $order, $signature)
    {
        $this
            ->logger
            ->debug(sprintf(
                'Signature for order with id %s was calculated to "%s"',
                $order->getOrderId(),
                $signature
            ));
    }

    /**
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
            $adaptedException = $this->adaptException($exception);
            $this->logException($adaptedException);

            throw $adaptedException;
        }

        return $encodedData;
    }

    /**
     * @param \Exception $exception
     *
     * @return SignatureCalculatorException
     */
    private function adaptException(\Exception $exception)
    {
        return new SignatureCalculatorException(
            $exception->getMessage(),
            $exception->getCode(),
            $exception
        );
    }

    /**
     * @param \Exception $exception
     */
    private function logException(\Exception $exception)
    {
        $this
            ->logger
            ->error(sprintf(
                '%s thrown %s with message "%s"',
                get_class($this),
                get_class($exception),
                $exception->getMessage()
            ));
    }
}
