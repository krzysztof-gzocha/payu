<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order;

/**
 * Interface OrderInterface
 * @package Team3\Order
 */
interface OrderInterface
{
    /**
     * @return BuyerInterface
     */
    public function getBuyer();

    /**
     * @return GeneralInterface
     */
    public function getGeneral();

    /**
     * @return ProductCollectionInterface
     */
    public function getProductCollection();

    /**
     * @return ShippingMethodCollectionInterface
     */
    public function getShippingMethodCollection();

    /**
     * @return UrlsInterface
     */
    public function getUrls();
}
