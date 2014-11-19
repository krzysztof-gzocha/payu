<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer\Adapter;

use JMS\Serializer\Annotation as JMS;
use Team3\Order\Model\ShippingMethods\ShippingMethodInterface;

/**
 * Class ShippingMethodAdapter
 * @package Team3\Order\Serializer\Adapter
 * @JMS\ExclusionPolicy("all")
 */
class ShippingMethodAdapter
{
    /**
     * @var ShippingMethodInterface
     */
    protected $shippingMethod;

    /**
     * @param ShippingMethodInterface $shippingMethod
     */
    public function __construct(
        ShippingMethodInterface $shippingMethod
    ) {
        $this->shippingMethod = $shippingMethod;
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("country")
     */
    public function getCountry()
    {
        return $this->shippingMethod->getCountry();
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("name")
     */
    public function getName()
    {
        return $this->shippingMethod->getName();
    }

    /**
     * @return int
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("price")
     */
    public function getPrice()
    {
        return $this->shippingMethod->getPrice()->getValueWithoutSeparation(2);
    }
}
