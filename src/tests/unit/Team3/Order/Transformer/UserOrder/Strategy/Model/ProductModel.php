<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace tests\unit\Team3\Order\Transformer\UserOrder\Strategy\Model;

use Team3\Order\Annotation\PayU;

class ProductModel
{
    private $name;
    private $quantity;
    private $unitPrice;

    /**
     * @param $name
     * @param $quantity
     * @param $unitPrice
     */
    public function __construct($name, $quantity, $unitPrice)
    {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->unitPrice = $unitPrice;
    }

    /**
     * @return string
     * @PayU(propertyName="product.name")
     */
    private function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     * @PayU(propertyName="product.quantity")
     */
    private function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return float
     * @PayU(propertyName="product.unitPrice")
     */
    private function getPrice()
    {
        return $this->unitPrice;
    }
}
