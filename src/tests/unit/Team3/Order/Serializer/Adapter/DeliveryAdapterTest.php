<?php
namespace Team3\Order\Serializer\Adapter;

use Team3\Order\Model\Buyer\DeliveryInterface;
use tests\unit\Team3\Order\Serializer\OrderHelper;

/**
 * Class DeliveryAdapterTest
 * @package Team3\Order\Serializer\Adapter
 * @group serializer
 */
class DeliveryAdapterTest extends \Codeception\TestCase\Test
{
    /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var DeliveryInterface
     */
    protected $delivery;

    /**
     * @var DeliveryAdapter
     */
    protected $adapter;

    protected function _before()
    {
        $this->delivery = OrderHelper::getOrderWithDeliveryAndInvoice()
            ->getBuyer()
            ->getDelivery();

        $this->adapter = new DeliveryAdapter($this->delivery);
    }

    public function testIfMethodsAreProxed()
    {
        $this->assertEquals(
            $this->delivery->getCity(),
            $this->adapter->getCity()
        );
        $this->assertEquals(
            $this->delivery->getStreet(),
            $this->adapter->getStreet()
        );
        $this->assertEquals(
            $this->delivery->getRecipientName(),
            $this->adapter->getRecipientName()
        );
        $this->assertEquals(
            $this->delivery->getRecipientEmail(),
            $this->adapter->getRecipientEmail()
        );
        $this->assertEquals(
            $this->delivery->getRecipientPhone(),
            $this->adapter->getRecipientPhone()
        );
        $this->assertEquals(
            $this->delivery->getCountryCode(),
            $this->adapter->getCountryCode()
        );
        $this->assertEquals(
            $this->delivery->getName(),
            $this->adapter->getName()
        );
        $this->assertEquals(
            $this->delivery->getPostalCode(),
            $this->adapter->getPostalCode()
        );
    }
}
