<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Model\Urls;

use Team3\Order\Model\IsFilledTrait;

class Urls implements UrlsInterface
{
    use IsFilledTrait;

    /**
     * @var string
     */
    protected $continueUrl;

    /**
     * @var string
     */
    protected $notifyUrl;

    /**
     * @var string
     */
    protected $orderUrl;

    /**
     * @return string
     */
    public function getContinueUrl()
    {
        return $this->continueUrl;
    }

    /**
     * @param string $continueUrl
     *
     * @return Urls
     */
    public function setContinueUrl($continueUrl)
    {
        $this->continueUrl = $continueUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getNotifyUrl()
    {
        return $this->notifyUrl;
    }

    /**
     * @param string $notifyUrl
     *
     * @return Urls
     */
    public function setNotifyUrl($notifyUrl)
    {
        $this->notifyUrl = $notifyUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrderUrl()
    {
        return $this->orderUrl;
    }

    /**
     * @param string $orderUrl
     *
     * @return Urls
     */
    public function setOrderUrl($orderUrl)
    {
        $this->orderUrl = $orderUrl;

        return $this;
    }
}
