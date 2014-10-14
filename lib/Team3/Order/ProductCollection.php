<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order;

/**
 * Class ProductCollection
 * @package Team3\Order
 */
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
        return array_values($this->products);
    }

    /**
     * @param array $products
     *
     * @return ProductCollection
     */
    public function setProducts(array $products)
    {
        $this->products = $products;

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
