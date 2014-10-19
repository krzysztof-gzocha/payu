<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer\ArrayAdapter;

class GeneralParametersNames
{
    const CUSTOMER_IP = 'customerIp';
    const ORDER_ID = 'extOrderId';
    const MERCHANT_ID = 'merchantPosId';
    const DESCRIPTION = 'description';
    const ADDITIONAL_DESCRIPTION = 'additionalDescription';
    const CURRENCY_CODE = 'currencyCode';
    const TOTAL_AMOUNT = 'totalAmount';
    const SIGNATURE = 'OpenPayu-Signature';
}
