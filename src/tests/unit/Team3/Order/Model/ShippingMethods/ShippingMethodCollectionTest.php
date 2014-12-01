<?php
namespace Team3\Order\Model\ShippingMethods;

class ShippingMethodCollectionTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testCountMethod()
    {
        $smc = new ShippingMethodCollection();
        $this->assertCount(
            0,
            $smc->getShippingMethods()
        );
        $smc->setShippingMethods([1, 2, 3]);
        $this->assertCount(
            3,
            $smc->getShippingMethods()
        );
        $this->assertEquals(
            3,
            $smc->count()
        );
        $this->assertEquals(
            3,
            count($smc)
        );
    }

    public function testIterator()
    {
        $smc = new ShippingMethodCollection();
        $this->assertInstanceOf(
            '\Iterator',
            $smc->getIterator()
        );
    }

    public function testIfIsFilled()
    {
        $smc = new ShippingMethodCollection([1, 2]);
        $this->assertTrue($smc->isFilled());
    }
}
