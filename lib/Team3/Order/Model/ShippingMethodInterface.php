<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order\Model;

interface ShippingMethodInterface
{
    /**
     * @return string
     */
    public function getCountry();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return int
     */
    public function getPrice();
}
