<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer\ArrayAdapter\Step;

use Team3\Order\Model\Buyer\InvoiceInterface;
use Team3\Order\Model\OrderInterface;
use Team3\Order\Serializer\ArrayAdapter\Names\InvoiceParametersNames as InvoiceNames;

class InvoiceAdapterStep extends AbstractAdapterStep
{
    /**
     * @param OrderInterface $order
     *
     * @return array
     */
    public function toArray(OrderInterface $order)
    {
        $invoice = $order->getBuyer()->getInvoice();
        $resultArray = [
            InvoiceNames::STREET => $invoice->getStreet(),
            InvoiceNames::POSTAL_CODE => $invoice->getPostalCode(),
            InvoiceNames::CITY => $invoice->getCity(),
            InvoiceNames::COUNTRY_CODE => $invoice->getCountryCode(),
        ];

        return $this->addOptional(
            $resultArray,
            $invoice
        );
    }

    /**
     * @param OrderInterface $order
     *
     * @return bool
     */
    public function shouldAdapt(OrderInterface $order)
    {
        if (!$order->getBuyer() || $order->getBuyer()->getInvoice()) {
            return false;
        }
        $invoice = $order->getBuyer()->getInvoice();

        return $invoice->getStreet()
            && $invoice->getPostalCode()
            && $invoice->getCity()
            && $invoice->getCountryCode();
    }

    /**
     * @param array            $result
     * @param InvoiceInterface $invoice
     *
     * @return array
     */
    private function addOptional(array $result, InvoiceInterface $invoice)
    {
        if ($invoice->getName()) {
            $result[InvoiceNames::NAME] = $invoice->getName();
        }

        if ($invoice->getRecipientName()) {
            $result[InvoiceNames::RECIPIENT_NAME] = $invoice->getRecipientName();
        }

        if ($invoice->getRecipientEmail()) {
            $result[InvoiceNames::RECIPIENT_EMAIL] = $invoice->getRecipientEmail();
        }

        if ($invoice->getRecipientPhone()) {
            $result[InvoiceNames::RECIPIENT_PHONE] = $invoice->getRecipientPhone();
        }

        if ($invoice->getTin()) {
            $result[InvoiceNames::TIN] = $invoice->getTin();
        }

        if ($invoice->isEInvoiceRequested()) {
            $result[InvoiceNames::EINVOICE_REQUESTED] = $invoice->isEInvoiceRequested() ? 'true' : 'false';
        }

        return $result;
    }
}
