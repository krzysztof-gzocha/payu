<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order\Model\ShippingMethods;

use Team3\Order\Model\IsFilledInterface;
use Team3\Order\Model\Money\MoneyInterface;

interface ShippingMethodInterface extends IsFilledInterface
{
    /**
     * @return string
     */
    public function getCountry();

    /**
     * @param string $country
     *
     * @return ShippingMethod
     */
    public function setCountry($country);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return ShippingMethod
     */
    public function setName($name);

    /**
     * @return MoneyInterface
     */
    public function getPrice();

    /**
     * @param MoneyInterface $price
     *
     * @return ShippingMethod
     */
    public function setPrice(MoneyInterface $price);
}
