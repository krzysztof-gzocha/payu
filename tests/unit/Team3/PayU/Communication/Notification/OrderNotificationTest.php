<?php
namespace Team3\PayU\Communication\Notification;


use Team3\PayU\Order\Model\Order;
use Team3\PayU\Order\Model\OrderInterface;

class OrderNotificationTest extends \Codeception\TestCase\Test
{
    const ORDER_ID = 123;

    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testSetter()
    {
        $notification = new OrderNotification();
        $notification->setOrder($this->getOrder(self::ORDER_ID));

        $this->assertInstanceOf(
            'Team3\PayU\Order\Model\OrderInterface',
            $notification->getOrder()
        );

        $this->assertEquals(
            self::ORDER_ID,
            $notification->getOrder()->getOrderId()
        );
    }

    /**
     * @param string $orderId
     *
     * @return OrderInterface
     */
    private function getOrder($orderId)
    {
        return (new Order())->setOrderId($orderId);
    }
}
