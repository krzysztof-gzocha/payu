<?php
namespace Team3\Communication\Response;

use Team3\Communication\Request\RequestStatus;
use Team3\Order\Model\Order;

/**
 * Class OrderStatusResponseTest
 * @package Team3\Communication\Response
 * @group communication
 */
class OrderStatusResponseTest extends \Codeception\TestCase\Test
{
    const ORDER_ID = '123';
    const STATUS_CODE = 'Status code';
    const DESCRIPTION = 'Description';
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testParameters()
    {
        $order = new Order();
        $order->setOrderId(self::ORDER_ID);

        $requestStatus = new RequestStatus();
        $requestStatus->setCode(self::STATUS_CODE);
        $requestStatus->setDescription(self::DESCRIPTION);

        $orderStatusResponse = new OrderStatusResponse();
        $orderStatusResponse->setOrders([$order]);
        $orderStatusResponse->setRequestStatus($requestStatus);

        $this->assertEquals(
            1,
            $orderStatusResponse->getOrdersCount()
        );

        $this->assertEquals(
            self::ORDER_ID,
            $orderStatusResponse->getFirstOrder()->getOrderId()
        );

        $this->assertTrue(
            is_array($orderStatusResponse->getOrders())
        );

        $this->assertCount(
            1,
            $orderStatusResponse->getOrders()
        );
    }

    /**
     * @throws NoOrdersInResponseException
     * @expectedException \Team3\Communication\Response\NoOrdersInResponseException
     */
    public function testException()
    {
        $orderStatusResponse = new OrderStatusResponse();
        $orderStatusResponse->getFirstOrder();
    }
}
