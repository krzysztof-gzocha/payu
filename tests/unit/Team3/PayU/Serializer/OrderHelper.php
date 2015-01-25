<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace tests\unit\Team3\PayU\Serializer;

use Team3\PayU\Order\Model\Buyer\Delivery;
use Team3\PayU\Order\Model\Buyer\Invoice;
use Team3\PayU\Order\Model\Money\Money;
use Team3\PayU\Order\Model\Order;
use Team3\PayU\Order\Model\OrderInterface;
use Team3\PayU\Order\Model\Products\Product;
use Team3\PayU\Order\Model\ShippingMethods\ShippingMethod;

/**
 * Class OrderHelper
 * @package tests\unit\Team3\PayU\Serializer
 * @group money
 */
class OrderHelper
{
    /**
     * @return string
     */
    public static function getOrderAsJson()
    {
        return '{"buyer":{"email":"krzysztof.gzocha@xsolve.pl","firstName":"Gzocha","phone":"123456789"},"continueUrl":"localhost","currencyCode":"PLN","customerIp":"127.0.0.1","description":"Description","extOrderId":"123","merchantPosId":"145227","notifyUrl":"localhost","orderUrl":"localhost","products":[{"name":"Product 1","quantity":1,"unitPrice":40000},{"name":"Product 2","quantity":1,"unitPrice":60000}],"shippingMethods":[{"country":"PLN","name":"shipping","price":10000}],"OpenPayU-Signature":"signature","totalAmount":100000}';
    }

    public static function getOrderWithDeliveryAndInvoiceAsJson()
    {
        return '{"buyer":{"delivery":{"city":"Warsaw","countryCode":"PL","name":"Delivery","postalCode":"99-999","recipientEmail":"krzysztof.gzocha@xsolve.pl","recipientName":"Krzysiek Gzocha","recipientPhone":"123456789","street":"some street"},"email":"krzysztof.gzocha@xsolve.pl","firstName":"Gzocha","invoice":{"city":"Warsaw","countryCode":"PL","einvoiceRequested":true,"name":"Some name","postalCode":"99-999","recipientEmail":"krzysztof.gzocha@xsolve.pl","recipientName":"Krzysztof Gzocha","recipientPhone":"123456789","tin":"123456","street":"some street"},"phone":"123456789"},"continueUrl":"localhost","currencyCode":"PLN","customerIp":"127.0.0.1","description":"Description","extOrderId":"123","merchantPosId":"145227","notifyUrl":"localhost","orderUrl":"localhost","products":[{"name":"Product 1","quantity":1,"unitPrice":40000},{"name":"Product 2","quantity":1,"unitPrice":60000}],"shippingMethods":[{"country":"PLN","name":"shipping","price":10000}],"OpenPayU-Signature":"signature","totalAmount":100000}';
    }

    /**
     * @return OrderInterface
     */
    public static function getOrderWithoutDeliveryAndInvoice()
    {
        $order = new Order();

        $order
            ->setCustomerIp('127.0.0.1')
            ->setMerchantPosId('145227')
            ->setDescription('Description')
            ->setCurrencyCode('PLN')
            ->setTotalAmount(new Money(1000))
            ->setOrderId(123)
            ->setSignature('signature')
            ->setNotifyUrl('localhost')
            ->setContinueUrl('localhost')
            ->setOrderUrl('localhost');

        $order
            ->getBuyer()
            ->setFirstName('Krzysztof')
            ->setLastName('Gzocha')
            ->setEmail('krzysztof.gzocha@xsolve.pl')
            ->setPhone('123456789');

        $order
            ->getProductCollection()
            ->addProduct(
                (new Product())
                    ->setName('Product 1')
                    ->setQuantity(1)
                    ->setUnitPrice(new Money(400))
            )
            ->addProduct(
                (new Product())
                    ->setName('Product 2')
                    ->setQuantity(1)
                    ->setUnitPrice(new Money(600))
            );

        $order
            ->getShippingMethodCollection()
            ->addShippingMethod(
                (new ShippingMethod())
                    ->setName('shipping')
                    ->setCountry('PLN')
                    ->setPrice(new Money(100))
            );

        return $order;
    }

    /**
     * @return OrderInterface
     */
    public static function getOrderWithDeliveryAndInvoice()
    {
        $order = self::getOrderWithoutDeliveryAndInvoice();

        $order
            ->getBuyer()
            ->setDelivery(
                (new Delivery())
                    ->setName('Delivery')
                    ->setCity('Warsaw')
                    ->setCountryCode('PL')
                    ->setPostalCode('99-999')
                    ->setRecipientEmail('krzysztof.gzocha@xsolve.pl')
                    ->setRecipientName('Krzysiek Gzocha')
                    ->setRecipientPhone('123456789')
                    ->setStreet('some street')
            )
            ->setInvoice(
                (new Invoice())
                    ->setStreet('some street')
                    ->setRecipientPhone('123456789')
                    ->setRecipientName('Krzysztof Gzocha')
                    ->setRecipientEmail('krzysztof.gzocha@xsolve.pl')
                    ->setRecipientTin('123456')
                    ->setCity('Warsaw')
                    ->setCountryCode('PL')
                    ->setEInvoiceRequested(true)
                    ->setName('Some name')
                    ->setPostalCode('99-999')
            );

        return $order;
    }
}
