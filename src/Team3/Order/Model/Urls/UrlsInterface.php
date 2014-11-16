<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order\Model\Urls;

use Team3\Order\Model\IsFilledInterface;

interface UrlsInterface extends IsFilledInterface
{
    /**
     * @return string
     */
    public function getContinueUrl();

    /**
     * @param string $continueUrl
     *
     * @return Urls
     */
    public function setContinueUrl($continueUrl);

    /**
     * @return string
     */
    public function getNotifyUrl();

    /**
     * @param string $notifyUrl
     *
     * @return Urls
     */
    public function setNotifyUrl($notifyUrl);

    /**
     * @return string
     */
    public function getOrderUrl();

    /**
     * @param string $orderUrl
     *
     * @return Urls
     */
    public function setOrderUrl($orderUrl);
}
