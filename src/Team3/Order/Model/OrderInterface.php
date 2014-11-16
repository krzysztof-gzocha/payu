<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order\Model;

use Team3\Order\Model\Buyer\BuyerInterface;
use Team3\Order\Model\General\GeneralInterface;
use Team3\Order\Model\Products\ProductCollectionInterface;
use Team3\Order\Model\ShippingMethods\ShippingMethodCollectionInterface;
use Team3\Order\Model\Urls\UrlsInterface;

interface OrderInterface extends IsFilledInterface
{
    /**
     * @return BuyerInterface
     */
    public function getBuyer();

    /**
     * @param BuyerInterface $buyer
     *
     * @return Order
     */
    public function setBuyer(BuyerInterface $buyer);

    /**
     * @return GeneralInterface
     */
    public function getGeneral();

    /**
     * @param GeneralInterface $general
     *
     * @return Order
     */
    public function setGeneral(GeneralInterface $general);

    /**
     * @return ProductCollectionInterface
     */
    public function getProductCollection();

    /**
     * @param ProductCollectionInterface $productCollection
     *
     * @return Order
     */
    public function setProductCollection(ProductCollectionInterface $productCollection);

    /**
     * @return ShippingMethodCollectionInterface
     */
    public function getShippingMethodCollection();

    /**
     * @param ShippingMethodCollectionInterface $shippingMethodCollection
     *
     * @return Order
     */
    public function setShippingMethodCollection(ShippingMethodCollectionInterface $shippingMethodCollection);

    /**
     * @return UrlsInterface
     */
    public function getUrls();

    /**
     * @param UrlsInterface $urls
     *
     * @return Order
     */
    public function setUrls(UrlsInterface $urls);
}
