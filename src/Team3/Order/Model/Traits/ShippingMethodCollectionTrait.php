<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Model\Traits;

use Team3\Order\Model\ShippingMethods\ShippingMethodCollection;
use Team3\Order\Model\ShippingMethods\ShippingMethodCollectionInterface;

trait ShippingMethodCollectionTrait
{
    /**
     * @var ShippingMethodCollectionInterface
     * @JMS\Type("array<Team3\Order\Model\ShippingMethods\ShippingMethod>")
     * @JMS\SerializedName("shippingMethods")
     * @JMS\Accessor(setter="setShippingMethodCollectionFromDeserialization")
     */
    protected $shippingMethodCollection;

    /**
     * @return ShippingMethodCollectionInterface
     */
    public function getShippingMethodCollection()
    {
        return $this->shippingMethodCollection;
    }

    /**
     * @param ShippingMethodCollectionInterface $shippingMethodCollection
     *
     * @return $this
     */
    public function setShippingMethodCollection(
        ShippingMethodCollectionInterface $shippingMethodCollection
    ) {
        $this->shippingMethodCollection = $shippingMethodCollection;

        return $this;
    }

    /**
     * @param array $shippingMethods
     *
     * @return $this
     */
    public function setShippingMethodCollectionFromDeserialization(
        array $shippingMethods
    ) {
        $this->setShippingMethodCollection(
            new ShippingMethodCollection($shippingMethods)
        );

        return $this;
    }
}
