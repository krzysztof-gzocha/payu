<?php
namespace Team3\PayU\Communication\Response;


use Team3\PayU\Communication\Request\Model\RequestStatus;
use Team3\PayU\Communication\Request\OrderCancelRequest;

class OrderCancelResponseTest extends \Codeception\TestCase\Test
{
    const PAYU_ORDER_ID = '123456';
    const ORDER_ID = '987654';
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testSetters()
    {
        $response = new OrderCancelResponse();
        $this->assertTrue(
            $response->supports($this->getOrderCancelRequest())
        );
        $response->setPayUOrderId(self::PAYU_ORDER_ID);
        $response->setOrderId(self::ORDER_ID);
        $response->setStatus(new RequestStatus());

        $this->assertEquals(
            self::PAYU_ORDER_ID,
            $response->getPayUOrderId()
        );

        $this->assertEquals(
            self::ORDER_ID,
            $response->getOrderId()
        );

        $this->assertInstanceOf(
            '\Team3\PayU\Communication\Request\Model\RequestStatus',
            $response->getStatus()
        );
    }

    /**
     * @return OrderCancelRequest
     */
    private function getOrderCancelRequest()
    {
        return $this
            ->getMockBuilder('\Team3\PayU\Communication\Request\OrderCancelRequest')
            ->disableOriginalConstructor()
            ->getMock();
    }
}
