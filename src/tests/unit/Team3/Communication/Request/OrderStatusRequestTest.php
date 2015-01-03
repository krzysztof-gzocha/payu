<?php
namespace Team3\Communication\Request;

use Team3\Order\Model\Order;

/**
 * Class OrderStatusRequestTest
 * @package Team3\Communication\Request
 * @group communication
 */
class OrderStatusRequestTest extends \Codeception\TestCase\Test
{
    const PAYU_ORDER_ID = '123';

    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testParameters()
    {
        $order = new Order();
        $order->setPayUOrderId(self::PAYU_ORDER_ID);
        $orderStatusRequest = new OrderStatusRequest($order);
        $this->assertNotEmpty(
            $orderStatusRequest->getDataObject()
        );
        $this->assertEquals(
            sprintf('orders/%s', self::PAYU_ORDER_ID),
            $orderStatusRequest->getPath()
        );
        $this->assertEquals(
            'GET',
            $orderStatusRequest->getMethod()
        );
    }
}
