<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy;

use Team3\Order\Model\OrderInterface;
use Team3\PropertyExtractor\ExtractorResult;

class GeneralTransformer implements UserOrderTransformerStrategyInterface
{
    /**
     * @inheritdoc
     */
    public function transform(
        OrderInterface $order,
        ExtractorResult $extractorResult
    ) {
        $this->copyValue(
            $order,
            $extractorResult->getPropertyName(),
            $extractorResult->getValue()
        );
    }

    /**
     * Will return true if property name starts with "general."
     *
     * @inheritdoc
     */
    public function supports($propertyName)
    {
        return true == preg_match('/^general\./', $propertyName);
    }

    /**
     * @param OrderInterface $order
     * @param                $propertyName
     * @param                $value
     */
    private function copyValue(
        OrderInterface $order,
        $propertyName,
        $value
    ) {
        switch ($propertyName) {
            case 'general.customerIp':
                $order->setCustomerIp($value);
                break;
            case 'general.orderId':
                $order->setOrderId($value);
                break;
            case 'general.additionalDescription':
                $order->setAdditionalDescription($value);
                break;
            case 'general.currencyCode':
                $order->setCurrencyCode($value);
                break;
            case 'general.description':
                $order->setDescription($value);
                break;
            case 'general.merchantPosId':
                $order->setMerchantPosId($value);
                break;
            case 'general.signature':
                $order->setSignature($value);
                break;
            case 'general.totalAmount':
                $order->setTotalAmount($value);
                break;
            default:
        }
    }
}
