<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer\Adapter;

use Team3\Order\Model\Products\ProductInterface;
use JMS\Serializer\Annotation as JMS;

/**
 * Class ProductAdapter
 * @package Team3\Order\Serializer\Adapter
 * @JMS\ExclusionPolicy("all")
 */
class ProductAdapter
{
    /**
     * @var ProductInterface
     */
    protected $product;

    /**
     * @param ProductInterface $product
     */
    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("name")
     */
    public function getName()
    {
        return $this->product->getName();
    }

    /**
     * @return int
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("quantity")
     */
    public function getQuantity()
    {
        return $this->product->getQuantity();
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("unitPrice")
     */
    public function getUnitPrice()
    {
        return $this->product->getUnitPrice();
    }
}
