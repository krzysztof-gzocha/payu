<?php
namespace Team3\Order\Autocomplete\Strategy;

use Team3\Configuration\Configuration;
use Team3\Configuration\Credentials\TestCredentials;
use Team3\Order\Model\Money\Money;
use Team3\Order\Model\Order;
use Team3\Order\Model\Products\Product;

class TotalAmountStrategyTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testAutocomplete()
    {
        $totalAmount = new TotalAmountStrategy();
        $totalAmount->autocomplete(
            $order = $this->getOrder(),
            new Configuration(new TestCredentials())
        );

        $this->assertEquals(
            40,
            $order->getTotalAmount()->getValue()
        );
    }

    public function testSupport()
    {
        $totalAmount = new TotalAmountStrategy();
        $this->assertTrue($totalAmount->supports($order = $this->getOrder()));

        $order->setTotalAmount(new Money(10));
        $this->assertFalse($totalAmount->supports($order));
    }

    /**
     * @return Order
     */
    private function getOrder()
    {
        $order = new Order();
        $order->getProductCollection()
            ->addProduct(
                (new Product())
                    ->setUnitPrice(new Money(10))
                    ->setQuantity(3)
            )
            ->addProduct(
                (new Product())
                    ->setUnitPrice(new Money(5))
                    ->setQuantity(2)
            );

        return $order;
    }
}
