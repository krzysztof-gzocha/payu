<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Autocomplete\Strategy;

use Team3\Configuration\ConfigurationInterface;
use Team3\Order\Autocomplete\OrderAutocompleteException;
use Team3\Order\Model\OrderInterface;
use Team3\SignatureCalculator\SignatureCalculatorException;
use Team3\SignatureCalculator\SignatureCalculatorInterface;

class SignatureStrategy implements AutocompleteStrategyInterface
{
    /**
     * @var SignatureCalculatorInterface
     */
    private $signatureCalculator;

    /**
     * @param SignatureCalculatorInterface $signatureCalculator
     */
    public function __construct(
        SignatureCalculatorInterface $signatureCalculator
    ) {
        $this->signatureCalculator = $signatureCalculator;
    }

    /**
     * @param OrderInterface $order
     *
     * @return bool
     */
    public function supports(OrderInterface $order)
    {
        return null === $order->getSignature();
    }

    /**
     * @param OrderInterface         $order
     * @param ConfigurationInterface $configuration
     */
    public function autocomplete(
        OrderInterface $order,
        ConfigurationInterface $configuration
    ) {
        $order->setSignature(
            $this->getSignature($order, $configuration)
        );
    }

    /**
     * @param OrderInterface         $order
     * @param ConfigurationInterface $configuration
     *
     * @return string
     * @throws OrderAutocompleteException
     */
    private function getSignature(
        OrderInterface $order,
        ConfigurationInterface $configuration
    ) {
        try {
            $signature = $this
                ->signatureCalculator
                ->calculate(
                    $order,
                    $configuration->getCredentials(),
                    $configuration->getCredentials()->getAlgorithm()
                );
        } catch (SignatureCalculatorException $exception) {
            throw new OrderAutocompleteException(
                $exception->getMessage(),
                $exception->getCode(),
                $exception
            );
        }

        return $signature;
    }
}
