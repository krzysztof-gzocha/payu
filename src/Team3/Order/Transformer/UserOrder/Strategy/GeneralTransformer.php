<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy;

use Team3\Order\Model\OrderInterface;
use Team3\Order\Transformer\UserOrder\TransformerProperties;
use Team3\Order\Transformer\UserOrder\TransformerPropertiesRegExp;
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
        return 1 === preg_match(
            TransformerPropertiesRegExp::GENERAL_REGEXP,
            $propertyName
        );
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
            case TransformerProperties::GENERAL_CUSTOMER_IP:
                $order->setCustomerIp($value);
                break;
            case TransformerProperties::GENERAL_ORDER_ID:
                $order->setOrderId($value);
                break;
            case TransformerProperties::GENERAL_ADDITIONAL_DESC:
                $order->setAdditionalDescription($value);
                break;
            case TransformerProperties::GENERAL_CURRENCY_CODE:
                $order->setCurrencyCode($value);
                break;
            case TransformerProperties::GENERAL_DESCRIPTION:
                $order->setDescription($value);
                break;
            case TransformerProperties::GENERAL_MERCHANT_POS_ID:
                $order->setMerchantPosId($value);
                break;
            case TransformerProperties::GENERAL_SIGNATURE:
                $order->setSignature($value);
                break;
            case TransformerProperties::GENERAL_TOTAL_AMOUNT:
                $order->setTotalAmount($value);
                break;
            default:
        }
    }
}
