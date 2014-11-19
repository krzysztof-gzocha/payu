<?php
namespace Team3\Order\Serializer\Adapter;

use Team3\Order\Model\Buyer\BuyerInterface;
use tests\unit\Team3\Order\Serializer\OrderHelper;

/**
 * Class BuyerAdapterTest
 * @package Team3\Order\Serializer\Adapter
 * @group serializer
 */
class BuyerAdapterTest extends \Codeception\TestCase\Test
{
    /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var BuyerInterface
     */
    protected $buyer;

    /**
     * @var BuyerAdapter
     */
    protected $adapter;

    protected function _before()
    {
        $this->buyer = OrderHelper::getOrderWithDeliveryAndInvoice()->getBuyer();
        $this->adapter = new BuyerAdapter($this->buyer);
    }

    public function testIfInvoiceIsProxed()
    {
        $this->assertInstanceOf(
            'Team3\Order\Serializer\Adapter\InvoiceAdapter',
            $this->adapter->getInvoice()
        );
    }

    public function testIfDeliveryIsProxed()
    {
        $this->assertInstanceOf(
            'Team3\Order\Serializer\Adapter\DeliveryAdapter',
            $this->adapter->getDelivery()
        );
    }

    public function testIfMethodsAreProxed()
    {
        $this->assertEquals(
            $this->buyer->getEmail(),
            $this->adapter->getEmail()
        );
        $this->assertEquals(
            $this->buyer->getFirstName(),
            $this->adapter->getFirstName()
        );
        $this->assertEquals(
            $this->buyer->getLastName(),
            $this->adapter->getLastName()
        );
        $this->assertEquals(
            $this->buyer->getPhone(),
            $this->adapter->getPhone()
        );
    }
}
