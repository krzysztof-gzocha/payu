<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order\Model\ShippingMethods;

interface ShippingMethodCollectionInterface extends \IteratorAggregate, \Countable
{
    /**
     * @return ShippingMethodInterface[]
     */
    public function getShippingMethods();

    /**
     * @inheritdoc
     */
    public function addShippingMethod(ShippingMethodInterface $shippingMethod);

    /**
     * @param ShippingMethodInterface[] $shippingMethods
     *
     * @return ShippingMethodCollection
     */
    public function setShippingMethods(array $shippingMethods);
}
