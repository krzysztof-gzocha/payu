<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Model\Products;

class ProductCollection implements ProductCollectionInterface
{
    /**
     * @var ProductInterface[]
     */
    protected $products;

    /**
     * @param ProductInterface[] $products
     */
    public function __construct(array $products = [])
    {
        $this->products = $products;
    }

    /**
     * Return true if given object is filled
     *
     * @return bool
     */
    public function isFilled()
    {
        return 0 < count($this->products);
    }

    /**
     * @param ProductInterface $product
     *
     * @return $this
     */
    public function addProduct(ProductInterface $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param array $products
     *
     * @return ProductCollection
     */
    public function setProducts(array $products)
    {
        $this->products = array_values($products);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->getProducts());
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->getProducts());
    }
}
