<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Order\Transformer\UserOrder\Strategy;

use Team3\PayU\Order\Model\Buyer\InvoiceInterface;
use Team3\PayU\Order\Model\OrderInterface;
use Team3\PayU\Order\Transformer\UserOrder\TransformerProperties;
use Team3\PayU\Order\Transformer\UserOrder\TransformerPropertiesRegExp;
use Team3\PayU\PropertyExtractor\ExtractorResult;

class InvoiceTransformer implements UserOrderTransformerStrategyInterface
{
    /**
     * @inheritdoc
     */
    public function transform(
        OrderInterface $order,
        ExtractorResult $extractorResult
    ) {
        $this
            ->copyValue(
                $order->getBuyer()->getInvoice(),
                $extractorResult->getPropertyName(),
                $extractorResult->getValue()
            )
            ->copyRecipientValue(
                $order->getBuyer()->getInvoice(),
                $extractorResult->getPropertyName(),
                $extractorResult->getValue()
            );
    }

    /**
     * @inheritdoc
     */
    public function supports($propertyName)
    {
        return 1 === preg_match(
            TransformerPropertiesRegExp::INVOICE_REGEXP,
            $propertyName
        );
    }

    /**
     * @param  InvoiceInterface   $invoice
     * @param  string             $propertyName
     * @param  string             $value
     * @return InvoiceTransformer
     */
    private function copyValue(
        InvoiceInterface $invoice,
        $propertyName,
        $value
    ) {
        switch ($propertyName) {
            case TransformerProperties::INVOICE_CITY:
                $invoice->setCity($value);
                break;
            case TransformerProperties::INVOICE_COUNTRY_CODE:
                $invoice->setCountryCode($value);
                break;
            case TransformerProperties::INVOICE_E_INVOICE_REQUESTED:
                $invoice->setEInvoiceRequested($value);
                break;
            case TransformerProperties::INVOICE_NAME:
                $invoice->setName($value);
                break;
            case TransformerProperties::INVOICE_POSTAL_CODE:
                $invoice->setPostalCode($value);
                break;
            case TransformerProperties::INVOICE_STREET:
                $invoice->setStreet($value);
                break;
        }

        return $this;
    }

    /**
     * @param  InvoiceInterface   $invoice
     * @param  string             $propertyName
     * @param  string             $value
     * @return InvoiceTransformer
     */
    private function copyRecipientValue(
        InvoiceInterface $invoice,
        $propertyName,
        $value
    ) {
        switch ($propertyName) {
            case TransformerProperties::INVOICE_RECIPIENT_EMAIL:
                $invoice->setRecipientEmail($value);
                break;
            case TransformerProperties::INVOICE_RECIPIENT_NAME:
                $invoice->setRecipientName($value);
                break;
            case TransformerProperties::INVOICE_RECIPIENT_PHONE:
                $invoice->setRecipientPhone($value);
                break;
            case TransformerProperties::INVOICE_RECIPIENT_TIN:
                $invoice->setRecipientTin($value);
                break;
        }

        return $this;
    }
}
