<?php
namespace Team3\Order\Serializer\Adapter;

use Team3\Order\Model\Money\Money;
use Team3\Order\Model\ShippingMethods\ShippingMethod;
use Team3\Order\Model\ShippingMethods\ShippingMethodInterface;

/**
 * Class ShippingMethodAdapterTest
 * @package Team3\Order\Serializer\Adapter
 * @group serializer
 */
class ShippingMethodAdapterTest extends \Codeception\TestCase\Test
{
    /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var ShippingMethodInterface
     */
    protected $shippingMethod;

    /**
     * @var ShippingMethodAdapter
     */
    protected $adapter;

    protected function _before()
    {
        $this->shippingMethod = (new ShippingMethod())
            ->setName('test')
            ->setPrice(new Money(12.34))
            ->setCountry('PL');
        $this->adapter = new ShippingMethodAdapter($this->shippingMethod);
    }

    public function testIfMethodsAreProxed()
    {
        $this->assertEquals(
            $this->shippingMethod->getName(),
            $this->adapter->getName()
        );
        $this->assertEquals(
            $this->shippingMethod->getPrice()->getValueWithoutSeparation(2),
            $this->adapter->getPrice()
        );
        $this->assertEquals(
            $this->shippingMethod->getCountry(),
            $this->adapter->getCountry()
        );
    }
}
