<?php
namespace Team3\PayU\Communication\Request;

use Team3\PayU\Order\Model\Order;

/**
 * Class OrderRetrieveRequestTest
 * @package Team3\PayU\Communication\Request
 * @group communication
 */
class OrderRetrieveRequestTest extends \Codeception\TestCase\Test
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
        $orderStatusRequest = new OrderRetrieveRequest($order);
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
