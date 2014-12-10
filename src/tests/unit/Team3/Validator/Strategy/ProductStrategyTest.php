<?php
namespace Team3\Validator\Strategy;

use Team3\Order\Model\Money\Money;
use Team3\Order\Model\Order;
use Team3\Order\Model\Products\Product;

/**
 * Class ProductStrategyTest
 * @package Team3\Validator\Strategy
 * @group validator
 */
class ProductStrategyTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testIfValidOrderWillPass()
    {
        $validator = new ProductStrategy();
        $result = $validator->validate($this->getValidOrder());

        $this->assertTrue($result);
    }

    public function testIfEmptyOrderWillPass()
    {
        $validator = new ProductStrategy();

        $this->assertTrue($validator->validate(new Order()));
    }

    public function testIfInvalidOrderWillNotPass()
    {
        $validator = new ProductStrategy();
        $this->assertFalse($validator->validate($this->getInvalidOrder()));
        $this->assertCount(3, $validator->getValidationErrors());
    }

    public function testInvalidOrderWithInvalidMoneyWillNotPass()
    {
        $validator = new ProductStrategy();
        $this->assertFalse($validator->validate($this->getInvalidOrderWithInvalidMoney()));
        $this->assertCount(3, $validator->getValidationErrors());
    }

    /**
     * @return Order
     */
    private function getValidOrder()
    {
        $order = new Order();
        $order
            ->getProductCollection()
            ->addProduct(
                (new Product())
                    ->setName('name')
                    ->setQuantity(1)
                    ->setUnitPrice(new Money(10))
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
            ->getProductCollection()
            ->addProduct(
                new Product()
            );

        return $order;
    }

    /**
     * @return Order
     */
    private function getInvalidOrderWithInvalidMoney()
    {
        $order = new Order();
        $order
            ->getProductCollection()
            ->addProduct(
                (new Product())
                    ->setUnitPrice(new Money(-1))
            );

        return $order;
    }
}
