<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy;

use Team3\Order\Model\Buyer\InvoiceInterface;
use Team3\Order\Model\OrderInterface;
use Team3\Order\PropertyExtractor\ExtractorResult;

class InvoiceTransformer implements UserOrderTransformerStrategyInterface
{
    /**
     * @inheritdoc
     */
    public function transform(
        OrderInterface $order,
        ExtractorResult $extractorResult
    ) {
        $this->copyValue(
            $order->getBuyer()->getInvoice(),
            $extractorResult
        );
    }

    /**
     * @inheritdoc
     */
    public function supports($propertyName)
    {
        return true == preg_match('/^invoice\.\w+/', $propertyName);
    }

    /**
     * @param InvoiceInterface $invoice
     * @param ExtractorResult  $extractorResult
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    private function copyValue(
        InvoiceInterface $invoice,
        ExtractorResult $extractorResult
    ) {
        switch ($extractorResult->getPropertyName()) {
            case 'invoice.street':
                $invoice->setStreet($extractorResult->getValue());
                break;
            case 'invoice.city':
                $invoice->setCity($extractorResult->getValue());
                break;
            case 'invoice.countryCode':
                $invoice->setCountryCode($extractorResult->getValue());
                break;
            case 'invoice.eInvoiceRequested':
                $invoice->setEInvoiceRequested($extractorResult->getValue());
                break;
            case 'invoice.name':
                $invoice->setName($extractorResult->getValue());
                break;
            case 'invoice.postalCode':
                $invoice->setPostalCode($extractorResult->getValue());
                break;
            case 'invoice.recipientEmail':
                $invoice->setRecipientEmail($extractorResult->getValue());
                break;
            case 'invoice.recipientName':
                $invoice->setRecipientName($extractorResult->getValue());
                break;
            case 'invoice.recipientPhone':
                $invoice->setRecipientPhone($extractorResult->getValue());
                break;
            case 'invoice.recipientTin':
                $invoice->setRecipientTin($extractorResult->getValue());
                break;
            default:
        }
    }
}
