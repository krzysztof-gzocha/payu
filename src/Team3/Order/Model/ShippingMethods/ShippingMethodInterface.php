<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order\Model\ShippingMethods;

use Team3\Order\Model\IsFilledInterface;

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
     * @return int
     */
    public function getPrice();

    /**
     * @param int $price
     *
     * @return ShippingMethod
     */
    public function setPrice($price);
}
