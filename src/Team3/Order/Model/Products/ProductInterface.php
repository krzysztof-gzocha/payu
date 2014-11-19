<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order\Model\Products;

use Team3\Order\Model\IsFilledInterface;
use Team3\Order\Model\Money\MoneyInterface;

interface ProductInterface extends IsFilledInterface
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
     * @return MoneyInterface
     */
    public function getUnitPrice();

    /**
     * @param MoneyInterface $unitPrice
     *
     * @return Product
     */
    public function setUnitPrice(MoneyInterface $unitPrice);
}
