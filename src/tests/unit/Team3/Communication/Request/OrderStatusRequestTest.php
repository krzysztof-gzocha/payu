<?php
namespace Team3\Communication\Request;

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
        $orderStatusRequest = new OrderStatusRequest(self::PAYU_ORDER_ID);
        $this->assertEmpty(
            $orderStatusRequest->getData()
        );
        $this->assertEquals(
            sprintf('/orders/%s', self::PAYU_ORDER_ID),
            $orderStatusRequest->getPath()
        );
    }
}
