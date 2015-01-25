<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\Order\Model\Traits;

use Team3\PayU\Order\Model\ShippingMethods\ShippingMethodCollection;
use Team3\PayU\Order\Model\ShippingMethods\ShippingMethodCollectionInterface;

trait ShippingMethodCollectionTrait
{
    /**
     * @var ShippingMethodCollectionInterface
     * @JMS\Type("array<Team3\PayU\Order\Model\ShippingMethods\ShippingMethod>")
     * @JMS\SerializedName("shippingMethods")
     * @JMS\Accessor(
     *      getter="getShippingMethodCollection",
     *      setter="setShippingMethodCollectionFromDeserialization"
     * )
     * @JMS\Groups({"shippingMethods"})
     */
    protected $shippingCollection;

    /**
     * @return ShippingMethodCollectionInterface
     */
    public function getShippingMethodCollection()
    {
        return $this->shippingCollection;
    }

    /**
     * @param ShippingMethodCollectionInterface $shippingMethodCollection
     *
     * @return $this
     */
    public function setShippingMethodCollection(
        ShippingMethodCollectionInterface $shippingMethodCollection
    ) {
        $this->shippingCollection = $shippingMethodCollection;

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
