<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order;

/**
 * Class ProductCollection
 * @package Team3\Order
 */
interface ProductCollectionInterface extends \IteratorAggregate, \Countable
{
    /**
     * @param ProductInterface $product
     *
     * @return $this
     */
    public function addProduct(ProductInterface $product);

    /**
     * @return ProductInterface[]
     */
    public function getProducts();
}
