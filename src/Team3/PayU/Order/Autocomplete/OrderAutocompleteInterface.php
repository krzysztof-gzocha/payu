<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Order\Autocomplete;

use Team3\PayU\Configuration\ConfigurationInterface;
use Team3\PayU\Order\Model\OrderInterface;

interface OrderAutocompleteInterface
{
    /**
     * @param OrderInterface         $order
     * @param ConfigurationInterface $configuration
     */
    public function autocomplete(
        OrderInterface $order,
        ConfigurationInterface $configuration
    );
}
