<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order\Model\Products;

interface ProductInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return Product
     */
    public function setName($name);

    /**
     * @return int
     */
    public function getQuantity();

    /**
     * @param int $quantity
     *
     * @return Product
     */
    public function setQuantity($quantity);

    /**
     * @return string
     */
    public function getUnitPrice();

    /**
     * @param string $unitPrice
     *
     * @return Product
     */
    public function setUnitPrice($unitPrice);
}
