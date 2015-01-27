<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Order\Transformer\UserOrder\Strategy;

use Team3\PayU\Order\Model\OrderInterface;
use Team3\PayU\Order\Transformer\UserOrder\TransformerProperties;
use Team3\PayU\Order\Transformer\UserOrder\TransformerPropertiesRegExp;
use Team3\PayU\PropertyExtractor\ExtractorResult;

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
        return 1 === preg_match(
            TransformerPropertiesRegExp::URL_REGEXP,
            $propertyName
        );
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
            case TransformerProperties::URLS_NOTIFY:
                $order->setNotifyUrl($extractorResult->getValue());
                break;
            case TransformerProperties::URLS_CONTINUE:
                $order->setContinueUrl($extractorResult->getValue());
                break;
            case TransformerProperties::URLS_ORDER:
                $order->setOrderUrl($extractorResult->getValue());
                break;
            default:
        }
    }
}
