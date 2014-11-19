<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Model\ShippingMethods;

use Team3\Order\Model\IsFilledTrait;
use Team3\Order\Model\Money\MoneyInterface;

class ShippingMethod implements ShippingMethodInterface
{
    use IsFilledTrait;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var MoneyInterface
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
     * @return MoneyInterface
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param MoneyInterface $price
     *
     * @return ShippingMethod
     */
    public function setPrice(MoneyInterface $price)
    {
        $this->price = $price;

        return $this;
    }
}
