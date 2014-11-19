<?php
namespace Team3\Order\Serializer\Adapter;

use Team3\Order\Model\OrderInterface;
use tests\unit\Team3\Order\Serializer\OrderHelper;

/**
 * Class OrderAdapterTest
 * @package Team3\Order\Serializer\Adapter
 * @group serializer
 */
class OrderAdapterTest extends \Codeception\TestCase\Test
{
    const PRODUCTS_COUNT = 2;
    const SHIPPING_METHODS_COUNT = 1;

    /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var OrderInterface
     */
    protected $order;

    /**
     * @var OrderAdapter
     */
    protected $adapter;

    protected function _before()
    {
        $this->order = OrderHelper::getOrderWithDeliveryAndInvoice();
        $this->adapter = new OrderAdapter($this->order);
    }

    public function testIfProductsRelatedMethodsAreProxed()
    {
        $this->assertCount(
            self::PRODUCTS_COUNT,
            $adaptedProducts = $this->adapter->getProducts()
        );

        foreach ($adaptedProducts as $adaptedProduct) {
            $this->assertInstanceOf(
                'Team3\Order\Serializer\Adapter\ProductAdapter',
                $adaptedProduct
            );
        }
    }

    public function testIfShippingRelatedMethodsAreProxed()
    {
        $this->assertCount(
            self::SHIPPING_METHODS_COUNT,
            $adaptedShippingMethods = $this->adapter->getShippingMethods()
        );

        foreach ($adaptedShippingMethods as $adaptedShippingMethod) {
            $this->assertInstanceOf(
                'Team3\Order\Serializer\Adapter\ShippingMethodAdapter',
                $adaptedShippingMethod
            );
        }
    }

    public function testIfBuyerIsProxed()
    {
        $this->assertInstanceOf(
            'Team3\Order\Serializer\Adapter\BuyerAdapter',
            $this->adapter->getBuyer()
        );
    }

    public function testIfUrlsAreProxed()
    {
        $this->assertEquals(
            $this->adapter->getContinueUrl(),
            $this->order->getUrls()->getContinueUrl()
        );
        $this->assertEquals(
            $this->adapter->getNotifyUrl(),
            $this->order->getUrls()->getNotifyUrl()
        );
        $this->assertEquals(
            $this->adapter->getOrderUrl(),
            $this->order->getUrls()->getOrderUrl()
        );
    }

    public function testIfGeneralParametersAreProxed()
    {
        $this->assertEquals(
            $this->adapter->getAdditionalDescription(),
            $this->order->getGeneral()->getAdditionalDescription()
        );
        $this->assertEquals(
            $this->adapter->getCurrencyCode(),
            $this->order->getGeneral()->getCurrencyCode()
        );
        $this->assertEquals(
            $this->adapter->getCustomerIp(),
            $this->order->getGeneral()->getCustomerIp()
        );
        $this->assertEquals(
            $this->adapter->getDescription(),
            $this->order->getGeneral()->getDescription()
        );
        $this->assertEquals(
            $this->adapter->getId(),
            $this->order->getGeneral()->getOrderId()
        );
        $this->assertEquals(
            $this->adapter->getMerchantPosId(),
            $this->order->getGeneral()->getMerchantPosId()
        );
        $this->assertEquals(
            $this->adapter->getSignature(),
            $this->order->getGeneral()->getSignature()
        );
        $this->assertEquals(
            $this->adapter->getTotalAmount(),
            $this->order->getGeneral()->getTotalAmount()
        );
    }
}
