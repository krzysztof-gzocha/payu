<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer\Adapter;

trait UrlsParametersTrait
{
    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("notifyUrl")
     */
    public function getNotifyUrl()
    {
        return $this->order->getUrls()->getNotifyUrl();
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("continueUrl")
     */
    public function getContinueUrl()
    {
        return $this->order->getUrls()->getContinueUrl();
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("orderUrl")
     */
    public function getOrderUrl()
    {
        return $this->order->getUrls()->getOrderUrl();
    }
}
