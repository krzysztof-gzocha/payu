<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\Order\Transformer\UserOrder;

/**
 * Class TransformerProperties is holding constants which represents transformer properties names
 * @package Team3\PayU\Order\Transformer\UserOrder
 */
final class TransformerProperties
{
    // Buyer parameters
    const BUYER_EMAIL = 'buyer.email';
    const BUYER_PHONE = 'buyer.phone';
    const BUYER_FIRST_NAME = 'buyer.firstName';
    const BUYER_LAST_NAME = 'buyer.lastName';

    // Delivery
    const DELIVERY_RECIPIENT_PHONE = 'delivery.recipientPhone';
    const DELIVERY_RECIPIENT_NAME = 'delivery.recipientName';
    const DELIVERY_RECIPIENT_EMAIL = 'delivery.recipientEmail';
    const DELIVERY_POSTAL_CODE = 'delivery.postalCode';
    const DELIVERY_CITY = 'delivery.city';
    const DELIVERY_COUNTRY_CODE = 'delivery.countryCode';
    const DELIVERY_NAME = 'delivery.name';
    const DELIVERY_STREET = 'delivery.street';

    // General
    const GENERAL_CUSTOMER_IP = 'general.customerIp';
    const GENERAL_ORDER_ID = 'general.orderId';
    const GENERAL_ADDITIONAL_DESC = 'general.additionalDescription';
    const GENERAL_CURRENCY_CODE = 'general.currencyCode';
    const GENERAL_DESCRIPTION = 'general.description';
    const GENERAL_MERCHANT_POS_ID = 'general.merchantPosId';
    const GENERAL_SIGNATURE = 'general.signature';
    const GENERAL_TOTAL_AMOUNT = 'general.totalAmount';

    // Invoice
    const INVOICE_CITY = 'invoice.city';
    const INVOICE_COUNTRY_CODE = 'invoice.countryCode';
    const INVOICE_E_INVOICE_REQUESTED = 'invoice.eInvoiceRequested';
    const INVOICE_NAME = 'invoice.name';
    const INVOICE_POSTAL_CODE = 'invoice.postalCode';
    const INVOICE_RECIPIENT_EMAIL = 'invoice.recipientEmail';
    const INVOICE_RECIPIENT_NAME = 'invoice.recipientName';
    const INVOICE_RECIPIENT_PHONE = 'invoice.recipientPhone';
    const INVOICE_RECIPIENT_TIN = 'invoice.recipientTin';
    const INVOICE_STREET = 'invoice.street';

    // Product
    const PRODUCT_UNIT_PRICE = 'product.unitPrice';
    const PRODUCT_QUANTITY = 'product.quantity';
    const PRODUCT_NAME = 'product.name';

    // Product collection
    const PRODUCT_COLLECTION = 'productCollection';

    // Recursive
    const RECURSIVE = 'follow';

    // Shipping method
    const SHIPPING_METHOD_NAME = 'shippingMethod.name';
    const SHIPPING_METHOD_PRICE = 'shippingMethod.price';
    const SHIPPING_METHOD_COUNTRY = 'shippingMethod.country';

    // Shipping method collection
    const SHIPPING_METHOD_COLLECTION = 'shippingMethodCollection';

    // Urls
    const URLS_NOTIFY = 'url.notify';
    const URLS_CONTINUE = 'url.continue';
    const URLS_ORDER = 'url.order';
}
