<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\Order\Model\Products;

use Team3\PayU\Order\Model\IsFilledTrait;
use Team3\PayU\Order\Model\Money\Money;
use Team3\PayU\Order\Model\Money\MoneyInterface;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Product
 * @package Team3\PayU\Order\Model\Products
 * @JMS\AccessorOrder("alphabetical")
 */
class Product implements ProductInterface
{
    use IsFilledTrait;

    /**
     * @var string
     * @JMS\Type("string")
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @var MoneyInterface
     * @JMS\SerializedName("unitPrice")
     * @JMS\Accessor(
     *      getter="getUnitPriceForSerialization",
     *      setter="setUnitPriceFromDeserialization"
     * )
     * @JMS\Type("integer")
     * @Assert\NotBlank()
     * @Assert\Valid()
     * @Assert\Type(type="object")
     */
    protected $unitPrice;

    /**
     * @var int
     * @JMS\Type("integer")
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     * @Assert\GreaterThan(0)
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
     * @return int
     */
    public function getUnitPriceForSerialization()
    {
        return $this->unitPrice->getValueWithoutSeparation(2);
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

    /**
     * @param int $price
     *
     * @return $this
     */
    public function setUnitPriceFromDeserialization($price)
    {
        $this->unitPrice = new Money($price / 100);

        return $this;
    }
}
