<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order;

/**
 * Interface ShippingMethodCollectionInterface
 * @package Team3\Order
 */
interface ShippingMethodCollectionInterface extends \IteratorAggregate, \Countable
{
    /**
     * @return ShippingMethodInterface[]
     */
    public function getShippingMethods();

    /**
     * @param ShippingMethodInterface $shippingMethod
     *
     * @return ShippingMethodInterface
     */
    public function addShippingMethod(ShippingMethodInterface $shippingMethod);
}
