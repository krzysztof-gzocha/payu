<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Model\Traits;

trait UrlsTrait
{
    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("continueUrl")
     */
    protected $continueUrl;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("notifyUrl")
     */
    protected $notifyUrl;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("orderUrl")
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
     * @return $this
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
     * @return $this
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
     * @return $this
     */
    public function setOrderUrl($orderUrl)
    {
        $this->orderUrl = $orderUrl;

        return $this;
    }
}
