<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer\ArrayAdapter\Names;

class InvoiceParametersNames
{
    const STREET = 'buyer.invoice.street';
    const POSTAL_CODE = 'buyer.invoice.postalCode';
    const CITY = 'buyer.invoice.city';
    const COUNTRY_CODE = 'buyer.invoice.countryCode';
    const NAME = 'buyer.invoice.name';

    const RECIPIENT_NAME = 'buyer.invoice.recipientName';
    const RECIPIENT_EMAIL = 'buyer.invoice.recipientEmail';
    const RECIPIENT_PHONE = 'buyer.invoice.recipientPhone';

    const TIN = 'buyer.invoice.tin';
    const EINVOICE_REQUESTED = 'buyer.invoice.einvoiceRequested';
}
