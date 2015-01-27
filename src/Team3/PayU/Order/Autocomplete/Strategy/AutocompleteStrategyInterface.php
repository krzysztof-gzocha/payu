<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Order\Autocomplete\Strategy;

use Team3\PayU\Order\Autocomplete\OrderAutocompleteInterface;
use Team3\PayU\Order\Model\OrderInterface;

interface AutocompleteStrategyInterface extends OrderAutocompleteInterface
{
    /**
     * @param OrderInterface $order
     *
     * @return bool
     */
    public function supports(OrderInterface $order);
}
