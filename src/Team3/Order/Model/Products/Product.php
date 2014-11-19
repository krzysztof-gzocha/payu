<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Model\Products;

use Team3\Order\Model\IsFilledTrait;
use Team3\Order\Model\Money\MoneyInterface;

class Product implements ProductInterface
{
    use IsFilledTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var MoneyInterface
     */
    protected $unitPrice;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     *
     * @return Product
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return MoneyInterface
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * @param MoneyInterface $unitPrice
     *
     * @return Product
     */
    public function setUnitPrice(MoneyInterface $unitPrice)
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }
}
