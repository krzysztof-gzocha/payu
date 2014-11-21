<?php
namespace Team3\Order\Model;


use Team3\Order\Model\Buyer\Buyer;
use Team3\Order\Model\General\General;
use Team3\Order\Model\Products\ProductCollection;
use Team3\Order\Model\ShippingMethods\ShippingMethodCollection;
use Team3\Order\Model\Urls\Urls;

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

        $order->setGeneral(new General());
        $this->assertInstanceOf(
            'Team3\Order\Model\General\GeneralInterface',
            $order->getGeneral()
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

        $order->setUrls(new Urls());
        $this->assertInstanceOf(
            'Team3\Order\Model\Urls\UrlsInterface',
            $order->getUrls()
        );
    }

}
