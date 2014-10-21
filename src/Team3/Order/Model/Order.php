<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Model;

use Team3\Order\Model\Buyer\Buyer;
use Team3\Order\Model\Buyer\BuyerInterface;
use Team3\Order\Model\General\General;
use Team3\Order\Model\General\GeneralInterface;
use Team3\Order\Model\Products\ProductCollection;
use Team3\Order\Model\Products\ProductCollectionInterface;
use Team3\Order\Model\ShippingMethods\ShippingMethodCollection;
use Team3\Order\Model\ShippingMethods\ShippingMethodCollectionInterface;
use Team3\Order\Model\Urls\Urls;
use Team3\Order\Model\Urls\UrlsInterface;

class Order implements OrderInterface
{
    /**
     * @var GeneralInterface
     */
    protected $general;

    /**
     * @var BuyerInterface
     */
    protected $buyer;

    /**
     * @var UrlsInterface
     */
    protected $urls;

    /**
     * @var ProductCollectionInterface
     */
    protected $productCollection;

    /**
     * @var ShippingMethodCollectionInterface
     */
    protected $shippingMethodCollection;

    public function __construct()
    {
        $this->general = new General();
        $this->buyer = new Buyer();
        $this->urls = new Urls();
        $this->productCollection = new ProductCollection();
        $this->shippingMethodCollection = new ShippingMethodCollection();
    }

    /**
     * @return BuyerInterface
     */
    public function getBuyer()
    {
        return $this->buyer;
    }

    /**
     * @param BuyerInterface $buyer
     *
     * @return Order
     */
    public function setBuyer(BuyerInterface $buyer)
    {
        $this->buyer = $buyer;

        return $this;
    }

    /**
     * @return GeneralInterface
     */
    public function getGeneral()
    {
        return $this->general;
    }

    /**
     * @param GeneralInterface $general
     *
     * @return Order
     */
    public function setGeneral(GeneralInterface $general)
    {
        $this->general = $general;

        return $this;
    }

    /**
     * @return ProductCollectionInterface
     */
    public function getProductCollection()
    {
        return $this->productCollection;
    }

    /**
     * @param ProductCollectionInterface $productCollection
     *
     * @return Order
     */
    public function setProductCollection(
        ProductCollectionInterface $productCollection
    ) {
        $this->productCollection = $productCollection;

        return $this;
    }

    /**
     * @return ShippingMethodCollectionInterface
     */
    public function getShippingMethodCollection()
    {
        return $this->shippingMethodCollection;
    }

    /**
     * @param ShippingMethodCollectionInterface $shippingMethodCollection
     *
     * @return Order
     */
    public function setShippingMethodCollection(
        ShippingMethodCollectionInterface $shippingMethodCollection
    ) {
        $this->shippingMethodCollection = $shippingMethodCollection;

        return $this;
    }

    /**
     * @return UrlsInterface
     */
    public function getUrls()
    {
        return $this->urls;
    }

    /**
     * @param UrlsInterface $urls
     *
     * @return Order
     */
    public function setUrls(UrlsInterface $urls)
    {
        $this->urls = $urls;

        return $this;
    }
}
