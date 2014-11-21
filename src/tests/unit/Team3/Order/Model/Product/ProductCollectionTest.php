<?php
namespace Team3\Order\Model\Product;


use Team3\Order\Model\Products\ProductCollection;

class ProductCollectionTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testIsFilled()
    {
        $pc = new ProductCollection();

        $this->assertFalse($pc->isFilled());
        $pc->setProducts([1, 2, 3]);
        $this->assertTrue($pc->isFilled());
    }

    public function testSetProducts()
    {
        $productCollection = new ProductCollection();
        $productCollection->setProducts(['123' => '456']);

        $this->assertEquals(
            '456',
            $productCollection->getProducts()[0]
        );
    }

    public function testCount()
    {
        $productCollection = new ProductCollection(['1', '2', '3']);

        $this->assertEquals(
            '3',
            $productCollection->count()
        );
        $this->assertEquals(
            '3',
            count($productCollection)
        );
    }

    public function testIterator()
    {
        $productCollection = new ProductCollection();

        $this->assertInstanceOf(
            '\Iterator',
            $productCollection->getIterator()
        );
    }
}
