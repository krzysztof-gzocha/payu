<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace tests\unit\Team3\Order\Serializer;

use Team3\Order\Model\Buyer\Delivery;
use Team3\Order\Model\Buyer\Invoice;
use Team3\Order\Model\Order;
use Team3\Order\Model\OrderInterface;
use Team3\Order\Model\Products\Product;
use Team3\Order\Model\ShippingMethods\ShippingMethod;

class OrderHelper
{
    /**
     * @return string
     */
    public static function getOrderAsJson()
    {
        return '{"buyer":{"email":"krzysztof.gzocha@xsolve.pl","firstName":"Krzysztof","lastName":"Gzocha","phone":"123456789"},"continueUrl":"localhost","currencyCode":"PLN","customerIp":"127.0.0.1","description":"Description","extOrderId":"123","merchantPosId":"145227","notifyUrl":"localhost","orderUrl":"localhost","products":[{"name":"Product 1","quantity":"1","unitPrice":"400"},{"name":"Product 2","quantity":"1","unitPrice":"600"}],"shippingMethods":[{"country":"PLN","name":"shipping","price":"100"}],"OpenPayU-Signature":"signature","totalAmount":1000}';
    }

    public static function getOrderWithDeliveryAndInvoiceAsJson()
    {
        return '{"buyer":{"email":"krzysztof.gzocha@xsolve.pl","firstName":"Krzysztof","lastName":"Gzocha","phone":"123456789","delivery":{"city":"Warsaw","countryCode":"PL","name":"Delivery","postalCode":"99-999","recipientEmail":"krzysztof.gzocha@xsolve.pl","recipientName":"Krzysiek Gzocha","recipientPhone":"123456789","street":"some street"},"invoice":{"city":"Warsaw","countryCode":"PL","name":"Some name","postalCode":"99-999","recipientEmail":"krzysztof.gzocha@xsolve.pl","recipientName":"Krzysztof Gzocha","recipientPhone":"123456789","tin":"123456","street":"some street","einvoiceRequested":true}},"continueUrl":"localhost","currencyCode":"PLN","customerIp":"127.0.0.1","description":"Description","extOrderId":"123","merchantPosId":"145227","notifyUrl":"localhost","orderUrl":"localhost","products":[{"name":"Product 1","quantity":"1","unitPrice":"400"},{"name":"Product 2","quantity":"1","unitPrice":"600"}],"shippingMethods":[{"country":"PLN","name":"shipping","price":"100"}],"OpenPayU-Signature":"signature","totalAmount":1000}';
    }

    /**
     * @return OrderInterface
     */
    public static function getOrderWithoutDeliveryAndInvoice()
    {
        $order = new Order();

        $order
            ->getGeneral()
            ->setCustomerIp('127.0.0.1')
            ->setMerchantPosId('145227')
            ->setDescription('Description')
            ->setCurrencyCode('PLN')
            ->setTotalAmount(1000)
            ->setOrderId(123)
            ->setSignature('signature');

        $order
            ->getUrls()
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
                    ->setUnitPrice(400)
            )
            ->addProduct(
                (new Product())
                    ->setName('Product 2')
                    ->setQuantity(1)
                    ->setUnitPrice(600)
            );

        $order
            ->getShippingMethodCollection()
            ->addShippingMethod(
                (new ShippingMethod())
                    ->setName('shipping')
                    ->setCountry('PLN')
                    ->setPrice('100')
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
