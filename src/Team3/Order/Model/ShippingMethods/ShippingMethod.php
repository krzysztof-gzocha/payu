<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Model\ShippingMethods;

use Team3\Order\Model\IsFilledTrait;
use Team3\Order\Model\Money\Money;
use Team3\Order\Model\Money\MoneyInterface;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ShippingMethod
 * @package Team3\Order\Model\ShippingMethods
 * @JMS\AccessorOrder("alphabetical")
 */
class ShippingMethod implements ShippingMethodInterface
{
    use IsFilledTrait;

    /**
     * @var string
     * @JMS\Type("string")
     * @Assert\Country()
     * @Assert\NotBlank()
     */
    protected $country;

    /**
     * @var MoneyInterface
     * @JMS\Accessor(
     *      getter="getPriceForSerialization",
     *      setter="setPriceFromDeserialization"
     * )
     * @JMS\Type("integer")
     * @Assert\Type(type="object")
     * @Assert\Valid
     */
    protected $price;

    /**
     * @var string
     * @JMS\Type("string")
     * @Assert\NotNull
     */
    protected $name;

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @return ShippingMethod
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

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
     * @return ShippingMethod
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return MoneyInterface
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getPriceForSerialization()
    {
        return $this->price->getValueWithoutSeparation(2);
    }

    /**
     * @param MoneyInterface $price
     *
     * @return ShippingMethod
     */
    public function setPrice(MoneyInterface $price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @param int $price
     *
     * @return $this
     */
    public function setPriceFromDeserialization($price)
    {
        $this->price = new Money($price / 100);

        return $this;
    }
}
