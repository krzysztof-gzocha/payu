<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order;

/**
 * Interface UrlsInterface
 * @package Order
 */
interface UrlsInterface
{
    /**
     * @return string
     */
    public function getContinueUrl();

    /**
     * @return string
     */
    public function getNotifyUrl();

    /**
     * @return string
     */
    public function getOrderUrl();
}
