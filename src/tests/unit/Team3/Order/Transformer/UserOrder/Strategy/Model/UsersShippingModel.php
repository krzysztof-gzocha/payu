<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace tests\unit\Team3\Order\Transformer\UserOrder\Strategy\Model;

use Team3\Order\Annotation\PayU;

class UsersShippingModel
{
    /**
     * @return string
     * @PayU(propertyName="shippingMethod.name")
     */
    private function getName()
    {
        return 'some name';
    }

    /**
     * @return float
     * @PayU(propertyName="shippingMethod.price")
     */
    private function getPrice()
    {
        return 123.34;
    }

    /**
     * @return string
     * @PayU(propertyName="shippingMethod.country")
     */
    private function getCountry()
    {
        return 'PL';
    }
}
