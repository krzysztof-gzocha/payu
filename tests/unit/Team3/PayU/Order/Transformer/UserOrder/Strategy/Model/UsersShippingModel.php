<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace tests\unit\Team3\PayU\Order\Transformer\UserOrder\Strategy\Model;

use Team3\PayU\Annotation\PayU;
use Team3\PayU\Order\Model\Money\Money;
use Team3\PayU\Order\Model\Money\MoneyInterface;

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
     * @return MoneyInterface
     * @PayU(propertyName="shippingMethod.price")
     */
    private function getPrice()
    {
        return new Money(123.34);
    }

    /**
     * @return string
     * @PayU(propertyName="shippingMethod.country")
     */
    private function getCountry()
    {
        return 'PL';
    }

    /**
     * @return int
     * @PayU(propertyName="shippingMethod.someMethod")
     */
    private function someMethod()
    {
        return 123;
    }
}
