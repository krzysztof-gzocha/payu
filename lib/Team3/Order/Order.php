<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order;

/**
 * Class Order
 * @package Team3\Order
 */
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
