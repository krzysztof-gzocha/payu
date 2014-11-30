<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy;

use Team3\Order\Model\OrderInterface;
use Team3\PropertyExtractor\ExtractorResult;

class UrlsTransformer implements UserOrderTransformerStrategyInterface
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
            $extractorResult
        );
    }

    /**
     * @inheritdoc
     */
    public function supports($propertyName)
    {
        return true == preg_match('/^url\.\w+/', $propertyName);
    }

    /**
     * @param OrderInterface  $order
     * @param ExtractorResult $extractorResult
     */
    private function copyValue(
        OrderInterface $order,
        ExtractorResult $extractorResult
    ) {
        switch ($extractorResult->getPropertyName()) {
            case 'url.notify':
                $order->setNotifyUrl($extractorResult->getValue());
                break;
            case 'url.continue':
                $order->setContinueUrl($extractorResult->getValue());
                break;
            case 'url.order':
                $order->setOrderUrl($extractorResult->getValue());
                break;
            default:
        }
    }
}
