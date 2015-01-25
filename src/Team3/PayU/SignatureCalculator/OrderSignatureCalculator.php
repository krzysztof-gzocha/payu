<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\SignatureCalculator;

use Psr\Log\LoggerInterface;
use Team3\PayU\Configuration\Credentials\CredentialsInterface;
use Team3\PayU\Order\Model\OrderInterface;
use Team3\PayU\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;
use Team3\PayU\SignatureCalculator\Encoder\EncoderInterface;
use Team3\PayU\SignatureCalculator\ParametersSorter\ParametersSorterInterface;

class OrderSignatureCalculator implements OrderSignatureCalculatorInterface
{
    const SIGNATURE_FORMAT = 'signature=%s;algorithm=%s;sender=%s';

    /**
     * @var SignatureCalculatorInterface
     */
    private $signatureCalculator;

    /**
     * @var ParametersSorterInterface
     */
    private $parametersSorter;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param EncoderInterface          $encoder
     * @param ParametersSorterInterface $parametersSorter
     * @param LoggerInterface           $logger
     */
    public function __construct(
        EncoderInterface $encoder,
        ParametersSorterInterface $parametersSorter,
        LoggerInterface $logger
    ) {
        $this->signatureCalculator = new SignatureCalculator($encoder);
        $this->parametersSorter = $parametersSorter;
        $this->logger = $logger;
    }

    /**
     * Calculates signature only for model which implements OrderInterface.
     * Signature for order is string with multiple variables described in SIGNATURE_FORMAT.
     * It uses SignatureCalculatorInterface to calculate one of the parameters.
     *
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
        $signature = $this->signatureCalculator->calculate(
            $this->getSortedParameters($order),
            $credentials,
            $algorithm
        );

        $signature = sprintf(
            self::SIGNATURE_FORMAT,
            $signature,
            $algorithm->getName(),
            $credentials->getMerchantPosId()
        );

        $this->logCalculatedSignature($order, $signature);

        return $signature;
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
}
