<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy;

use Team3\Order\Model\Buyer\BuyerInterface;
use Team3\Order\Model\OrderInterface;
use Team3\PropertyExtractor\ExtractorResult;

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
        return true == preg_match('/^buyer\.\w+/', $propertyName);
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
            case 'buyer.email':
                $buyer->setEmail($extractorResult->getValue());
                break;
            case 'buyer.phone':
                $buyer->setPhone($extractorResult->getValue());
                break;
            case 'buyer.firstName':
                $buyer->setFirstName($extractorResult->getValue());
                break;
            case 'buyer.lastName':
                $buyer->setLastName($extractorResult->getValue());
                break;
            default:
        }
    }
}
