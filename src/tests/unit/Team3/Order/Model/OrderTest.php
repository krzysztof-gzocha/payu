<?php
namespace Team3\Order\Model;

use Team3\Order\Model\Buyer\Buyer;
use Team3\Order\Model\Products\ProductCollection;
use Team3\Order\Model\ShippingMethods\ShippingMethodCollection;

class OrderTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testSetters()
    {
        $order = new Order();

        $order->setBuyer(new Buyer());
        $this->assertInstanceOf(
            'Team3\Order\Model\Buyer\BuyerInterface',
            $order->getBuyer()
        );

        $order->setProductCollection(new ProductCollection());
        $this->assertInstanceOf(
            'Team3\Order\Model\Products\ProductCollectionInterface',
            $order->getProductCollection()
        );

        $order->setShippingMethodCollection(new ShippingMethodCollection());
        $this->assertInstanceOf(
            'Team3\Order\Model\ShippingMethods\ShippingMethodCollectionInterface',
            $order->getShippingMethodCollection()
        );
    }
}
