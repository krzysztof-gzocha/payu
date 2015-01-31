<?php
namespace Team3\PayU\Communication\Request;


use Team3\PayU\Order\Model\Order;
use Team3\PayU\Order\Model\OrderInterface;

class OrderCancelRequestTest extends \Codeception\TestCase\Test
{
    const PAYU_ORDER_ID = '123456';
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testConstructor()
    {
        $request = new OrderCancelRequest($order = $this->getOrder());

        $this->assertEquals(
            'DELETE',
            $request->getMethod()
        );

        $this->assertEquals(
            sprintf('orders/%s', $order->getPayUOrderId()),
            $request->getPath()
        );
    }

    /**
     * @return OrderInterface
     */
    private function getOrder()
    {
        $order = new Order();
        $order->setPayUOrderId(self::PAYU_ORDER_ID);

        return $order;
    }
}
