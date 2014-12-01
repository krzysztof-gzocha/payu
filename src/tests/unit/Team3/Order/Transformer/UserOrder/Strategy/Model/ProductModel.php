<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace tests\unit\Team3\Order\Transformer\UserOrder\Strategy\Model;

use Team3\Order\Annotation\PayU;
use Team3\Order\Model\Money\Money;
use Team3\Order\Model\Money\MoneyInterface;

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
        $this->unitPrice = new Money($unitPrice);
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
     * @return MoneyInterface
     * @PayU(propertyName="product.unitPrice")
     */
    private function getPrice()
    {
        return $this->unitPrice;
    }

    /**
     * @return int
     * @PayU(propertyName="product.someMethod")
     */
    private function someMethod()
    {
        return 1234;
    }
}
