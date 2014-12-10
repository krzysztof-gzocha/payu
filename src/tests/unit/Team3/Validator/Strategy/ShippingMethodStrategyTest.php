<?php
namespace Team3\Validator\Strategy;

use Team3\Order\Model\Money\Money;
use Team3\Order\Model\Order;
use Team3\Order\Model\ShippingMethods\ShippingMethod;

/**
 * Class ShippingMethodStrategyTest
 * @package Team3\Validator\Strategy
 * @group validator
 */
class ShippingMethodStrategyTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testIfEmptyOrderWillPass()
    {
        $validator = new ShippingMethodStrategy();
        $this->assertTrue($validator->validate(new Order()));
    }

    public function testIfValidOrderWillPass()
    {
        $validator = new ShippingMethodStrategy();
        $this->assertTrue($validator->validate($this->getValidOrder()));
    }

    public function testIfInvalidOrderWillNotPass()
    {
        $validator = new ShippingMethodStrategy();
        $this->assertFalse($validator->validate($this->getInvalidOrder()));
        $this->assertCount(3, $validator->getValidationErrors());
    }

    public function testIfInvalidOrderWithoutMoneyWillNotPass()
    {
        $validator = new ShippingMethodStrategy();
        $this->assertFalse($validator->validate($this->getInvalidOrderWithoutMoney()));
        $this->assertCount(3, $validator->getValidationErrors());
    }

    /**
     * @return Order
     */
    private function getValidOrder()
    {
        $order = new Order();
        $order
            ->getShippingMethodCollection()
            ->addShippingMethod(
                (new ShippingMethod())
                    ->setName('Name')
                    ->setCountry('CC')
                    ->setPrice(new Money(10))
            );

        return $order;
    }

    /**
     * @return Order
     */
    private function getInvalidOrder()
    {
        $order = new Order();
        $order
            ->getShippingMethodCollection()
            ->addShippingMethod(
                (new ShippingMethod())
                    ->setName('')
                    ->setCountry('ccc')
                    ->setPrice(new Money(-1))
            );

        return $order;
    }

    /**
     * @return Order
     */
    private function getInvalidOrderWithoutMoney()
    {
        $order = new Order();
        $order
            ->getShippingMethodCollection()
            ->addShippingMethod(
                (new ShippingMethod())
                    ->setName('')
                    ->setCountry('ccc')
            );

        return $order;
    }
}
