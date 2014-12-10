<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Validator\Strategy;

use Team3\Order\Model\Buyer\InvoiceInterface;
use Team3\Order\Model\OrderInterface;
use Team3\Validator\AbstractValidator;
use Team3\Validator\ValidationHelperTrait;

class InvoiceValidatorStrategy extends AbstractValidator
{
    use ValidationHelperTrait;

    /**
     * @inheritdoc
     */
    public function validate(OrderInterface $order)
    {
        $invoice = $order->getBuyer()->getInvoice();

        if ($this->shouldNotValidate($invoice)) {
            return true;
        }

        $this
            ->checkCity($invoice)
            ->checkCountryCode($invoice)
            ->checkPostalCode($invoice)
            ->checkStreet($invoice);

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
    protected function checkCity(InvoiceInterface $invoice)
    {
        if ($this->isStringEmpty($invoice->getCity())) {
            $this->addValidationError(
                $invoice,
                'City name of the invoice can not be empty',
                'city'
            );
        }

        return $this;
    }

    /**
     * @param InvoiceInterface $invoice
     *
     * @return $this
     */
    protected function checkCountryCode(InvoiceInterface $invoice)
    {
        if ($this->isCountryCodeIncorrect($invoice->getCountryCode())) {
            $this->addValidationError(
                $invoice,
                'Country code of the invoice can not be empty',
                'countryCode'
            );
        }

        return $this;
    }

    /**
     * @param InvoiceInterface $invoice
     *
     * @return $this
     */
    protected function checkPostalCode(InvoiceInterface $invoice)
    {
        if ($this->isStringEmpty($invoice->getPostalCode())) {
            $this->addValidationError(
                $invoice,
                'Postal code of the invoice can not be empty',
                'postalCode'
            );
        }

        return $this;
    }

    /**
     * @param InvoiceInterface $invoice
     *
     * @return $this
     */
    protected function checkStreet(InvoiceInterface $invoice)
    {
        if ($this->isStringEmpty($invoice->getStreet())) {
            $this->addValidationError(
                $invoice,
                'Street name of the invoice can not be empty',
                'street'
            );
        }

        return $this;
    }
}
