<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\Order\Transformer\UserOrder;

/**
 * Class TransformerPropertiesRegExp is holding constants that represents regular expressions
 * of transformer properties.
 *
 * @package Team3\PayU\Order\Transformer\UserOrder
 */
final class TransformerPropertiesRegExp
{
    const BUYER_REGEXP = '/^buyer\.\w+$/';
    const DELIVERY_REGEXP = '/^delivery\.\w+$/';
    const GENERAL_REGEXP = '/^general\.\w+$/';
    const INVOICE_REGEXP = '/^invoice\.\w+$/';
    const SHIPPING_METHOD_REGEXP = '/^shippingMethod\.\w+$/';
    const URL_REGEXP = '/^url\.\w+$/';
}
