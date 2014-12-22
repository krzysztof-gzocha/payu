<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy;

use Team3\Order\Model\Buyer\InvoiceInterface;
use Team3\Order\Model\OrderInterface;
use Team3\PropertyExtractor\ExtractorResult;

class InvoiceTransformer implements UserOrderTransformerStrategyInterface
{
    /**
     * @inheritdoc
     */
    public function transform(
        OrderInterface $order,
        ExtractorResult $extractorResult
    ) {
        $invoice = $order->getBuyer()->getInvoice();
        $property = $this->getInvoiceProperty($invoice, $extractorResult);

        if (null === $property) {
            return;
        }

        $property->setAccessible(true);
        $property->setValue($invoice, $extractorResult->getValue());
    }

    /**
     * @inheritdoc
     */
    public function supports($propertyName)
    {
        return true === (bool) preg_match('/^invoice\.\w+$/', $propertyName);
    }

    /**
     * @param InvoiceInterface $invoice
     * @param ExtractorResult  $extractorResult
     *
     * @return \ReflectionProperty|null
     */
    private function getInvoiceProperty(
        InvoiceInterface $invoice,
        ExtractorResult $extractorResult
    ) {
        $matches = [];
        preg_match('/^invoice\.([a-zA-z]+)$/', $extractorResult->getPropertyName(), $matches);

        try {
            $reflectionClass = new \ReflectionClass($invoice);
            $reflectionMethod = $reflectionClass->getProperty($matches[1]);
        } catch (\ReflectionException $exception) {
            return;
        }

        return $reflectionMethod;
    }
}
