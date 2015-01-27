<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Order\Autocomplete;

use Psr\Log\LoggerInterface;
use Team3\PayU\Order\Autocomplete\Strategy\AutocompleteStrategyInterface;
use Team3\PayU\Order\Autocomplete\Strategy\CustomerIpStrategy;
use Team3\PayU\Order\Autocomplete\Strategy\MerchantPosIdStrategy;
use Team3\PayU\Order\Autocomplete\Strategy\SignatureStrategy;
use Team3\PayU\Order\Autocomplete\Strategy\TotalAmountStrategy;
use Team3\PayU\SignatureCalculator\OrderSignatureCalculatorFactory;
use Team3\PayU\SignatureCalculator\OrderSignatureCalculatorInterface;

class OrderAutocompleteFactory implements OrderAutocompleteFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return OrderAutocompleteInterface
     */
    public function build(LoggerInterface $logger)
    {
        $orderAutocomplete = new OrderAutocomplete($logger);
        foreach ($this->getStrategies($logger) as $strategy) {
            $orderAutocomplete->addStrategy($strategy);
        }

        return $orderAutocomplete;
    }

    /**
     * @param LoggerInterface $logger
     *
     * @return AutocompleteStrategyInterface
     */
    private function getStrategies(LoggerInterface $logger)
    {
        return [
            new CustomerIpStrategy(),
            new MerchantPosIdStrategy(),
            new TotalAmountStrategy(),
            new SignatureStrategy($this->getSignatureCalculator($logger)),
        ];
    }

    /**
     * @param LoggerInterface $logger
     *
     * @return OrderSignatureCalculatorInterface
     */
    private function getSignatureCalculator(LoggerInterface $logger)
    {
        $calculatorFactory = new OrderSignatureCalculatorFactory();

        return $calculatorFactory->build($logger);
    }
}
