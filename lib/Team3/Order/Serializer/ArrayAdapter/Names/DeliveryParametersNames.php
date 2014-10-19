<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer\ArrayAdapter\Names;

class DeliveryParametersNames
{
    const STREET = 'buyer.delivery.street';
    const POSTAL_CODE = 'buyer.delivery.postalCode';
    const CITY = 'buyer.delivery.city';
    const COUNTRY_CODE = 'buyer.delivery.countryCode';
    const NAME = 'buyer.delivery.name';

    const RECIPIENT_NAME = 'buyer.delivery.recipientName';
    const RECIPIENT_EMAIL = 'buyer.delivery.recipientEmail';
    const RECIPIENT_PHONE = 'buyer.delivery.recipientPhone';
}
