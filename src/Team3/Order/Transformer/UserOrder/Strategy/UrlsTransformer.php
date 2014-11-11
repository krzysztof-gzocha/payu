<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy;

use Team3\Order\Model\OrderInterface;
use Team3\Order\Model\Urls\UrlsInterface;
use Team3\Order\PropertyExtractor\ExtractorResult;

class UrlsTransformer implements UserOrderTransformerStrategyInterface
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
            $order->getUrls(),
            $extractorResult
        );
    }

    /**
     * @inheritdoc
     */
    public function supports($propertyName)
    {
        return true == preg_match('/^.url\.\w+/', $propertyName);
    }

    /**
     * @param UrlsInterface   $urls
     * @param ExtractorResult $extractorResult
     */
    private function copyValue(
        UrlsInterface $urls,
        ExtractorResult $extractorResult
    ) {
        switch ($extractorResult->getPropertyName()) {
            case 'url.notify':
                $urls->setNotifyUrl($extractorResult->getValue());
                break;
            case 'url.continue':
                $urls->setContinueUrl($extractorResult->getValue());
                break;
            case 'url.order':
                $urls->setOrderUrl($extractorResult->getValue());
                break;
            default:
        }
    }
}
