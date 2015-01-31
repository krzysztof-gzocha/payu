<?php
namespace Team3\PayU\Communication\Response;

use Team3\PayU\Communication\Request\Model\RequestStatus;
use Team3\PayU\Order\Model\Order;

/**
 * Class OrderRetrieveResponseTest
 * @package Team3\PayU\Communication\Response
 * @group communication
 */
class OrderRetrieveResponseTest extends \Codeception\TestCase\Test
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

        $orderStatusResponse = new OrderRetrieveResponse();
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
     * @expectedException \Team3\PayU\Communication\Response\NoOrdersInResponseException
     */
    public function testException()
    {
        $orderStatusResponse = new OrderRetrieveResponse();
        $orderStatusResponse->getFirstOrder();
    }
}
