<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order\Model\Products;

use Team3\Order\Model\IsFilledInterface;

interface ProductCollectionInterface extends \IteratorAggregate, \Countable, IsFilledInterface
{
    /**
     * @param ProductInterface $product
     *
     * @return $this
     */
    public function addProduct(ProductInterface $product);

    /**
     * @inheritdoc
     */
    public function getProducts();

    /**
     * @param array $products
     *
     * @return ProductCollection
     */
    public function setProducts(array $products);
}
