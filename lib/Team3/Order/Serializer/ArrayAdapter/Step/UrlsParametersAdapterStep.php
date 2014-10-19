<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer\ArrayAdapter\Step;

use Team3\Order\Model\OrderInterface;
use Team3\Order\Serializer\ArrayAdapter\UrlsParametersNames as UrlsNames;

class UrlsParametersAdapterStep extends AbstractAdapterStep
{
    /**
     * @param OrderInterface $order
     *
     * @return array
     */
    public function toArray(OrderInterface $order)
    {
        $urls = $order->getUrls();
        $returnArray = [];

        if ($urls->getNotifyUrl()) {
            $returnArray[UrlsNames::NOTIFY_URL] = $urls->getNotifyUrl();
        }

        if ($urls->getContinueUrl()) {
            $returnArray[UrlsNames::CONTINUE_URL] = $urls->getContinueUrl();
        }

        if ($urls->getOrderUrl()) {
            $returnArray[UrlsNames::ORDER_URL] = $urls->getOrderUrl();
        }

        return $returnArray;
    }

    /**
     * @param OrderInterface $order
     *
     * @return bool
     */
    public function shouldAdapt(OrderInterface $order)
    {
        $urls = $order->getUrls();

        return $urls->getNotifyUrl()
            || $urls->getContinueUrl()
            || $urls->getOrderUrl();
    }
}
