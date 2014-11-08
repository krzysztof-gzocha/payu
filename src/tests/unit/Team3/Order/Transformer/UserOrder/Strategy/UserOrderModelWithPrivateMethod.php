<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace tests\unit\Team3\Order\Transformer\UserOrder\Strategy;

use Team3\Order\Annotation\PayU;

class UserOrderModelWithPrivateMethod
{
    /**
     * @var mixed
     */
    private $products;

    /**
     * @param mixed $products
     */
    public function __construct($products = [])
    {
        $this->products = $products;
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
        return rand(1, 100);
    }
}
