<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Model\ShippingMethods;

class ShippingMethod implements ShippingMethodInterface
{
    /**
     * @var string
     */
    protected $country;

    /**
     * @var int
     */
    protected $price;

    /**
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @return ShippingMethod
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return ShippingMethod
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $price
     *
     * @return ShippingMethod
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }
}
