<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Order\Model\Products;

use Team3\PayU\Order\Model\IsFilledInterface;

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
