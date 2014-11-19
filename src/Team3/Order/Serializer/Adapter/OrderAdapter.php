<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer\Adapter;

use JMS\Serializer\Annotation as JMS;
use Team3\Order\Model\OrderInterface;
use Team3\Order\Model\Products\ProductInterface;

/**
 * Class OrderAdapter
 * @package Team3\Order\Serializer
 * @JMS\ExclusionPolicy("all")
 * @JMS\AccessorOrder("alphabetical")
 */
class OrderAdapter implements AdapterInterface
{
    use GeneralParametersTrait;
    use UrlsParametersTrait;

    /**
     * @var OrderInterface
     */
    protected $order;

    /**
     * @param OrderInterface $order
     */
    public function __construct(OrderInterface $order)
    {
        $this->order = $order;
    }

    /**
     * @return ProductAdapter[]
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("array<Team3\Order\Serializer\Adapter\ProductAdapter>")
     * @JMS\SerializedName("products")
     */
    public function getProducts()
    {
        $originalProducts = $this->order->getProductCollection()->getProducts();
        $adaptedProducts = [];

        /** @var ProductInterface $originalProduct */
        foreach ($originalProducts as $originalProduct) {
            if ($originalProduct->isFilled()) {
                $adaptedProducts[] = new ProductAdapter($originalProduct);
            }
        }

        if (0 < count($adaptedProducts)) {
            return $adaptedProducts;
        }
    }

    /**
     * @return ShippingMethodAdapter[]
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("array<Team3\Order\Serializer\Adapter\ShippingMethodAdapter>")
     * @JMS\SerializedName("shippingMethods")
     */
    public function getShippingMethods()
    {
        $shippingMethods = $this->order->getShippingMethodCollection()->getShippingMethods();
        $adaptedMethods = [];

        foreach ($shippingMethods as $shippingMethod) {
            if ($shippingMethod->isFilled()) {
                $adaptedMethods[] = new ShippingMethodAdapter($shippingMethod);
            }
        }

        if (0 < count($adaptedMethods)) {
            return $adaptedMethods;
        }
    }

    /**
     * @return BuyerAdapter
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("Team3\Order\Serializer\Adapter\BuyerAdapter")
     * @JMS\SerializedName("buyer")
     */
    public function getBuyer()
    {
        if ($this->order->getBuyer()->isFilled()) {
            return new BuyerAdapter($this->order->getBuyer());
        }
    }
}
