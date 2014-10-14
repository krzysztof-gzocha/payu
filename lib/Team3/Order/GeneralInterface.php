<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order;

/**
 * Interface GeneralInterface
 * @package Team3\Order
 */
interface GeneralInterface
{
    /**
     * @return string
     */
    public function getAdditionalDescription();

    /**
     * @return string
     */
    public function getCurrencyCode();

    /**
     * @return string
     */
    public function getCustomerIp();

    /**
     * @return string
     */
    public function getMerchantPosId();

    /**
     * @return string
     */
    public function getOrderId();

    /**
     * @return string
     */
    public function getSignature();

    /**
     * @return int
     */
    public function getTotalAmount();
}
