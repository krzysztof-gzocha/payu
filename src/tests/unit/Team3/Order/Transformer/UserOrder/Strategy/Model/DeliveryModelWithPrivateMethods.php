<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace tests\unit\Team3\Order\Transformer\UserOrder\Strategy\Model;

use Team3\Order\Annotation\PayU;

class DeliveryModelWithPrivateMethods
{
    /**
     * @return string
     * @PayU(propertyName="delivery.city")
     */
    private function getCity()
    {
        return 'city';
    }

    /**
     * @return string
     * @PayU(propertyName="delivery.countryCode")
     */
    private function getCountryCode()
    {
        return 'PL';
    }

    /**
     * @return string
     * @PayU(propertyName="delivery.name")
     */
    private function getName()
    {
        return 'someName';
    }

    /**
     * @return string
     * @PayU(propertyName="delivery.postalCode")
     */
    private function getPostalCode()
    {
        return '00-000';
    }

    /**
     * @return string
     * @PayU(propertyName="delivery.recipientEmail")
     */
    private function getRecipientEmail()
    {
        return 'some@mail.com';
    }

    /**
     * @return string
     * @PayU(propertyName="delivery.recipientName")
     */
    private function getRecipientName()
    {
        return 'name';
    }

    /**
     * @return string
     * @PayU(propertyName="delivery.recipientPhone")
     */
    private function getRecipientPhone()
    {
        return '+00 123 456 789';
    }

    /**
     * @return string
     * @PayU(propertyName="delivery.street")
     */
    private function getStreet()
    {
        return 'street';
    }

    /**
     * @return string
     * @PayU(propertyName="delivery.someMethod")
     */
    private function someMethod()
    {
        return 'something';
    }
}
