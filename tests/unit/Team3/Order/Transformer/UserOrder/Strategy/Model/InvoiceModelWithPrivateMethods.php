<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace tests\unit\Team3\Order\Transformer\UserOrder\Strategy\Model;

use Team3\Annotation\PayU;

class InvoiceModelWithPrivateMethods
{
    /**
     * @return string
     * @PayU(propertyName="invoice.city")
     */
    private function getCity()
    {
        return 'city';
    }

    /**
     * @return string
     * @PayU(propertyName="invoice.countryCode")
     */
    private function getCountryCode()
    {
        return 'PL';
    }

    /**
     * @return boolean
     * @PayU(propertyName="invoice.eInvoiceRequested")
     */
    private function isEInvoiceRequested()
    {
        return true;
    }

    /**
     * @return string
     * @PayU(propertyName="invoice.name")
     */
    private function getName()
    {
        return 'Jan Kowalski';
    }

    /**
     * @return string
     * @PayU(propertyName="invoice.postalCode")
     */
    private function getPostalCode()
    {
        return '00-000';
    }

    /**
     * @return string
     * @PayU(propertyName="invoice.recipientEmail")
     */
    private function getRecipientEmail()
    {
        return 'another@email.com';
    }

    /**
     * @return string
     * @PayU(propertyName="invoice.recipientName")
     */
    private function getRecipientName()
    {
        return 'Janina Kowalska';
    }

    /**
     * @return string
     * @PayU(propertyName="invoice.recipientPhone")
     */
    private function getRecipientPhone()
    {
        return '+11 123 456 789';
    }

    /**
     * @return string
     * @PayU(propertyName="invoice.recipientTin")
     */
    private function getTin()
    {
        return 'some-tin-number-123';
    }

    /**
     * @return string
     * @PayU(propertyName="invoice.street")
     */
    private function getStreet()
    {
        return 'Some street name';
    }

    /**
     * @return int
     * @PayU(propertyName="invoice.someMethod")
     */
    private function someMethod()
    {
        return 123;
    }
}
