<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace tests\unit\Team3\Order\Transformer\UserOrder\Strategy\Model;

use Team3\Order\Annotation\PayU;

class BuyerModelWithPrivateMethods
{
    /**
     * @return string
     * @PayU(propertyName="buyer.firstName")
     */
    private function getFirstName()
    {
        return 'Krzysztof';
    }

    /**
     * @return string
     * @PayU(propertyName="buyer.lastName")
     */
    private function getLastName()
    {
        return 'Gzocha';
    }

    /**
     * @return string
     * @PayU(propertyName="buyer.phone")
     */
    private function getPhone()
    {
        return 'some-phone-123123';
    }

    /**
     * @return string
     * @PayU(propertyName="buyer.email")
     */
    private function getEmail()
    {
        return 'krzysztof.gzocha@xsolve.pl';
    }
}
