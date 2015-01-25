<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\Order\Transformer\UserOrder\Strategy;

use Team3\PayU\Order\Model\Buyer\DeliveryInterface;
use Team3\PayU\Order\Model\OrderInterface;
use Team3\PayU\Order\Transformer\UserOrder\TransformerProperties;
use Team3\PayU\Order\Transformer\UserOrder\TransformerPropertiesRegExp;
use Team3\PayU\PropertyExtractor\ExtractorResult;

class DeliveryTransformer implements UserOrderTransformerStrategyInterface
{
    /**
     * @inheritdoc
     */
    public function transform(
        OrderInterface $order,
        ExtractorResult $extractorResult
    ) {
        $this->copyValue(
            $order->getBuyer()->getDelivery(),
            $extractorResult
        );
    }

    /**
     * @inheritdoc
     */
    public function supports($propertyName)
    {
        return 1 === preg_match(
            TransformerPropertiesRegExp::DELIVERY_REGEXP,
            $propertyName
        );
    }

    /**
     * @param DeliveryInterface $delivery
     * @param ExtractorResult   $extractorResult
     */
    private function copyValue(
        DeliveryInterface $delivery,
        ExtractorResult $extractorResult
    ) {
        switch ($extractorResult->getPropertyName()) {
            case TransformerProperties::DELIVERY_RECIPIENT_PHONE:
                $delivery->setRecipientPhone($extractorResult->getValue());
                break;
            case TransformerProperties::DELIVERY_RECIPIENT_NAME:
                $delivery->setRecipientName($extractorResult->getValue());
                break;
            case TransformerProperties::DELIVERY_RECIPIENT_EMAIL:
                $delivery->setRecipientEmail($extractorResult->getValue());
                break;
            case TransformerProperties::DELIVERY_POSTAL_CODE:
                $delivery->setPostalCode($extractorResult->getValue());
                break;
            case TransformerProperties::DELIVERY_CITY:
                $delivery->setCity($extractorResult->getValue());
                break;
            case TransformerProperties::DELIVERY_COUNTRY_CODE:
                $delivery->setCountryCode($extractorResult->getValue());
                break;
            case TransformerProperties::DELIVERY_NAME:
                $delivery->setName($extractorResult->getValue());
                break;
            case TransformerProperties::DELIVERY_STREET:
                $delivery->setStreet($extractorResult->getValue());
                break;
            default:
        }
    }
}
