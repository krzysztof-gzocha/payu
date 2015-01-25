<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\Order\Transformer\UserOrder\Strategy;

use Team3\PayU\Order\Model\Buyer\BuyerInterface;
use Team3\PayU\Order\Model\OrderInterface;
use Team3\PayU\Order\Transformer\UserOrder\TransformerProperties;
use Team3\PayU\Order\Transformer\UserOrder\TransformerPropertiesRegExp;
use Team3\PayU\PropertyExtractor\ExtractorResult;

class BuyerTransformer implements UserOrderTransformerStrategyInterface
{
    /**
     * @inheritdoc
     */
    public function transform(
        OrderInterface $order,
        ExtractorResult $extractorResult
    ) {
        $this->copyValue(
            $order->getBuyer(),
            $extractorResult
        );
    }

    /**
     * @inheritdoc
     */
    public function supports($propertyName)
    {
        return 1 === preg_match(
            TransformerPropertiesRegExp::BUYER_REGEXP,
            $propertyName
        );
    }

    /**
     * @param BuyerInterface  $buyer
     * @param ExtractorResult $extractorResult
     */
    private function copyValue(
        BuyerInterface $buyer,
        ExtractorResult $extractorResult
    ) {
        switch ($extractorResult->getPropertyName()) {
            case TransformerProperties::BUYER_EMAIL:
                $buyer->setEmail($extractorResult->getValue());
                break;
            case TransformerProperties::BUYER_PHONE:
                $buyer->setPhone($extractorResult->getValue());
                break;
            case TransformerProperties::BUYER_FIRST_NAME:
                $buyer->setFirstName($extractorResult->getValue());
                break;
            case TransformerProperties::BUYER_LAST_NAME:
                $buyer->setLastName($extractorResult->getValue());
                break;
            default:
        }
    }
}
