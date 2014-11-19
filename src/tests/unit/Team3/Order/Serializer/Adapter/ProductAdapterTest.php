<?php
namespace Team3\Order\Serializer\Adapter;

use Team3\Order\Model\Money\Money;
use Team3\Order\Model\Products\Product;
use Team3\Order\Model\Products\ProductInterface;

/**
 * Class ProductAdapterTest
 * @package Team3\Order\Serializer\Adapter
 * @group serializer
 */
class ProductAdapterTest extends \Codeception\TestCase\Test
{
    /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var ProductInterface
     */
    protected $product;

    /**
     * @var ProductAdapter
     */
    protected $adapter;

    protected function _before()
    {
        $this->product = (new Product())
            ->setName('test')
            ->setQuantity(10)
            ->setUnitPrice(new Money(12.34));

        $this->adapter = new ProductAdapter($this->product);
    }

    public function testIfMethodsAreProxed()
    {
        $this->assertEquals(
            $this->product->getName(),
            $this->adapter->getName()
        );
        $this->assertEquals(
            $this->product->getQuantity(),
            $this->adapter->getQuantity()
        );
        $this->assertEquals(
            $this->product->getUnitPrice()->getValueWithoutSeparation(2),
            $this->adapter->getUnitPrice()
        );
    }
}
