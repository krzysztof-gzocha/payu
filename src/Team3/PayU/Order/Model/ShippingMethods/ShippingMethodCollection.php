<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Order\Model\ShippingMethods;

class ShippingMethodCollection implements ShippingMethodCollectionInterface
{
    /**
     * @var ShippingMethodInterface[]
     */
    protected $shippingMethods;

    /**
     * @param ShippingMethodInterface[] $shippingMethod
     */
    public function __construct(array $shippingMethod = [])
    {
        $this->shippingMethods = $shippingMethod;
    }

    /**
     * Return true if given object is filled
     *
     * @return bool
     */
    public function isFilled()
    {
        return 0 < count($this->shippingMethods);
    }

    /**
     * @return ShippingMethodInterface[]
     */
    public function getShippingMethods()
    {
        return $this->shippingMethods;
    }

    /**
     * @inheritdoc
     */
    public function addShippingMethod(ShippingMethodInterface $shippingMethod)
    {
        $this->shippingMethods[] = $shippingMethod;

        return $this;
    }

    /**
     * @param ShippingMethodInterface[] $shippingMethods
     *
     * @return ShippingMethodCollection
     */
    public function setShippingMethods(array $shippingMethods)
    {
        $this->shippingMethods = array_values($shippingMethods);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->getShippingMethods());
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->getShippingMethods());
    }
}
