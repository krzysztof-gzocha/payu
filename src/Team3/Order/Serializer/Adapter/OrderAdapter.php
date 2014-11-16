<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer\Adapter;

use JMS\Serializer\Annotation as JMS;
use Team3\Order\Model\OrderInterface;

/**
 * Class OrderAdapter
 * @package Team3\Order\Serializer
 * @JMS\ExclusionPolicy("all")
 * @JMS\AccessorOrder("alphabetical")
 */
class OrderAdapter
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
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("array<Team3\Order\Serializer\Adapter\ProductAdapter>")
     * @JMS\SerializedName("products")
     */
    public function getProducts()
    {
        $originalProducts = $this->order->getProductCollection()->getProducts();
        $adaptedProducts = [];

        foreach ($originalProducts as $originalProduct) {
            $adaptedProducts[] = new ProductAdapter($originalProduct);
        }

        return $adaptedProducts;
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
        return new BuyerAdapter($this->order->getBuyer());
    }
}
