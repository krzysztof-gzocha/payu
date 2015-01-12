<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Autocomplete\Strategy;

use Team3\Configuration\ConfigurationInterface;
use Team3\Order\Model\Money\Money;
use Team3\Order\Model\Money\MoneyInterface;
use Team3\Order\Model\OrderInterface;
use Team3\Order\Model\Products\ProductCollectionInterface;
use Team3\Order\Model\Products\ProductInterface;

class TotalAmountStrategy implements AutocompleteStrategyInterface
{
    /**
     * @param OrderInterface $order
     *
     * @return bool
     */
    public function supports(OrderInterface $order)
    {
        return 0 == $order->getTotalAmount()->getValue()
            && 0 < $order->getProductCollection()->count();
    }

    /**
     * @param OrderInterface         $order
     * @param ConfigurationInterface $configuration
     */
    public function autocomplete(
        OrderInterface $order,
        ConfigurationInterface $configuration
    ) {
        $order->setTotalAmount(
            $this->getProductsCost(
                $order->getProductCollection()
            )
        );
    }

    /**
     * @param ProductCollectionInterface $productCollection
     *
     * @return MoneyInterface
     */
    private function getProductsCost(
        ProductCollectionInterface $productCollection
    ) {
        $totalAmount = new Money(0);

        /** @var ProductInterface $product */
        foreach ($productCollection as $product) {
            // $totalAmount += $unitPrice * $quantity
            $totalAmount = $totalAmount->add(
                $product->getUnitPrice()->multiply(
                    $product->getQuantity()
                )
            );
        }

        return $totalAmount;
    }
}
