<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Validator\Strategy;

use Team3\Order\Model\Buyer\InvoiceInterface;
use Team3\Order\Model\OrderInterface;
use Team3\Validator\AbstractValidator;

class InvoiceValidatorStrategy extends AbstractValidator
{
    /**
     * @inheritdoc
     */
    public function validate(OrderInterface $order)
    {
        $invoice = $order->getBuyer()->getInvoice();

        if ($this->shouldNotValidate($invoice)) {
            return true;
        }

        $this->checkAddress($invoice);

        return $this->hasNoErrors();
    }

    /**
     * @param InvoiceInterface $invoice
     *
     * @return bool
     */
    protected function shouldNotValidate(InvoiceInterface $invoice)
    {
        return !$invoice->getCity()
            && !$invoice->getCountryCode()
            && !$invoice->getPostalCode()
            && !$invoice->getStreet();
    }

    /**
     * @param InvoiceInterface $invoice
     *
     * @return $this
     */
    protected function checkAddress(InvoiceInterface $invoice)
    {
        if (null == $invoice->getCity()) {
            $this->addValidationError(
                $invoice,
                'City name of the invoice can not be empty',
                'city'
            );
        }

        if (null == $invoice->getCountryCode()) {
            $this->addValidationError(
                $invoice,
                'Country code of the invoice can not be empty',
                'countryCode'
            );
        }

        if (null == $invoice->getPostalCode()) {
            $this->addValidationError(
                $invoice,
                'Postal code of the invoice can not be empty',
                'postalCode'
            );
        }

        if (null == $invoice->getStreet()) {
            $this->addValidationError(
                $invoice,
                'Street name of the invoice can not be empty',
                'street'
            );
        }

        return $this;
    }
}
