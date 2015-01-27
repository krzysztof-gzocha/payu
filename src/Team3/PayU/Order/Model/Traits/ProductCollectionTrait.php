<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Order\Model\Traits;

use Team3\PayU\Order\Model\Products\ProductCollection;
use Team3\PayU\Order\Model\Products\ProductCollectionInterface;

trait ProductCollectionTrait
{
    /**
     * @var ProductCollectionInterface
     * @JMS\Type("array<Team3\PayU\Order\Model\Products\Product>")
     * @JMS\SerializedName("products")
     * @JMS\Accessor(setter="setProductCollectionFromDeserialization")
     * @JMS\Groups({"products"})
     */
    protected $productCollection;

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
     * @return $this
     */
    public function setProductCollection(
        ProductCollectionInterface $productCollection
    ) {
        $this->productCollection = $productCollection;

        return $this;
    }

    /**
     * @param array $products
     *
     * @return $this
     */
    public function setProductCollectionFromDeserialization(
        array $products
    ) {
        $this->setProductCollection(
            new ProductCollection($products)
        );

        return $this;
    }
}
