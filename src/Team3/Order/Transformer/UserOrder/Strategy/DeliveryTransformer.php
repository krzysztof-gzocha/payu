<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy;

use Team3\Order\Model\Buyer\DeliveryInterface;
use Team3\Order\Model\OrderInterface;
use Team3\Order\PropertyExtractor\ExtractorResult;

class DeliveryTransformer implements UserOrderTransformerStrategyInterface
{
    /**
     * @inheritdoc
     */
    public function transform(
        OrderInterface $order,
        $userOrder,
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
        return true == preg_match('/^delivery\.\w+/', $propertyName);
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
            case 'delivery.recipientPhone':
                $delivery->setRecipientPhone($extractorResult->getValue());
                break;
            case 'delivery.recipientName':
                $delivery->setRecipientName($extractorResult->getValue());
                break;
            case 'delivery.recipientEmail':
                $delivery->setRecipientEmail($extractorResult->getValue());
                break;
            case 'delivery.postalCode':
                $delivery->setPostalCode($extractorResult->getValue());
                break;
            case 'delivery.city':
                $delivery->setCity($extractorResult->getValue());
                break;
            case 'delivery.countryCode':
                $delivery->setCountryCode($extractorResult->getValue());
                break;
            case 'delivery.name':
                $delivery->setName($extractorResult->getValue());
                break;
            case 'delivery.street':
                $delivery->setStreet($extractorResult->getValue());
                break;
            default:
        }
    }
}
