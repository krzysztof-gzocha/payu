<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Model;

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
