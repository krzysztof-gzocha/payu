<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace tests\unit\Team3\Order\Transformer\UserOrder\Strategy\Model;

use Team3\Annotation\PayU;
use Team3\Order\Model\Money\Money;

class UserOrderModelWithPrivateMethods
{
    /**
     * @var array
     */
    private $products;

    /**
     * @var array
     */
    private $shippingMethods;

    /**
     * @param mixed $products
     */
    public function __construct($products = [])
    {
        $this->products = $products;
        $this->shippingMethods = [
            new UsersShippingModel(),
        ];
    }

    /**
     * @return array
     * @PayU(propertyName="productCollection")
     */
    private function getProducts()
    {
        return $this->products;
    }

    /**
     * @return string
     * @PayU(propertyName="general.customerIp")
     */
    private function getCustomerIP()
    {
        return '127.0.0.1';
    }

    /**
     * @return int
     * @PayU(propertyName="general.orderId")
     */
    private function getId()
    {
        return rand(1, 100);
    }

    /**
     * @return string
     * @PayU(propertyName="general.additionalDescription")
     */
    private function getAdditionalDescription()
    {
        return 'additional description';
    }

    /**
     * @return string
     * @PayU(propertyName="general.currencyCode")
     */
    private function getCurrencyCode()
    {
        return 'EUR';
    }

    /**
     * @return string
     * @PayU(propertyName="general.description")
     */
    private function getDescription()
    {
        return 'description';
    }

    /**
     * @return int
     * @PayU(propertyName="general.merchantPosId")
     */
    private function getMerchantPosId()
    {
        return 123456;
    }

    /**
     * @return string
     * @PayU(propertyName="general.signature")
     */
    private function getSignature()
    {
        return md5('signature');
    }

    /**
     * @return int
     * @PayU(propertyName="general.totalAmount")
     */
    private function getTotalAmount()
    {
        return new Money(rand(1, 100));
    }

    /**
     * @return int
     * @PayU(propertyName="general.someMethod")
     */
    private function someMethodForGeneralParameters()
    {
        return 1234;
    }

    /**
     * @return string
     * @PayU(propertyName="url.notify")
     */
    private function getNotifyUrl()
    {
        return 'google.com';
    }

    /**
     * @return string
     * @PayU(propertyName="url.continue")
     */
    private function getContinueUrl()
    {
        return 'twitter.com';
    }

    /**
     * @return string
     * @PayU(propertyName="url.order")
     */
    private function getOrderUrl()
    {
        return 'facebook.com';
    }

    /**
     * @return string
     * @PayU(propertyName="url.something")
     */
    private function someMethodForUrl()
    {
        return 'test';
    }

    /**
     * @return array
     * @PayU(propertyName="shippingMethodCollection")
     */
    private function getShippingMethodCollection()
    {
        return $this->shippingMethods;
    }

    /**
     * @return void
     */
    public function clearShippingMethodCollection()
    {
        $this->shippingMethods = null;
    }
}
