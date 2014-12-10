<?php
namespace Team3\Validator\Strategy;


use Team3\Order\Model\Order;
use Team3\Order\Model\Products\Product;

/**
 * Class ProductCollectionStrategyTest
 * @package Team3\Validator\Strategy
 * @group validator
 */
class ProductCollectionStrategyTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testIfValidOrderWillPass()
    {
        $validator = new ProductCollectionStrategy();
        $result = $validator->validate($this->getValidOrder());

        $this->assertTrue($result);
    }

    public function testIfInvalidOrderWillNotPass()
    {
        $validator = new ProductCollectionStrategy();
        $result = $validator->validate(new Order());

        $this->assertFalse($result);
        $this->assertCount(1, $validator->getValidationErrors());
    }

    /**
     * @return Order
     */
    public function getValidOrder()
    {
        $order = new Order();

        $order
            ->getProductCollection()
            ->addProduct(new Product());

        return $order;
    }
}
