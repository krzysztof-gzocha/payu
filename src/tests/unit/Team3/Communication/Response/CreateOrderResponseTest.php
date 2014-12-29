<?php
namespace Team3\Communication\Response;

use Team3\Communication\Request\RequestStatus;

class CreateOrderResponseTest extends \Codeception\TestCase\Test
{
    const EXT_ORDER_ID = '123';
    const ORDER_ID = '456';
    const REDIRECT_URI = 'localhost';
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testParameters()
    {
        $response = new CreateOrderResponse();
        $response->setExtOrderId(self::EXT_ORDER_ID);
        $response->setOrderId(self::ORDER_ID);
        $response->setRedirectUri(self::REDIRECT_URI);
        $response->setRequestStatus(new RequestStatus());

        $this->assertEquals(
            self::EXT_ORDER_ID,
            $response->getExtOrderId()
        );

        $this->assertEquals(
            self::ORDER_ID,
            $response->getOrderId()
        );

        $this->assertEquals(
            self::REDIRECT_URI,
            $response->getRedirectUri()
        );

        $this->assertInstanceOf(
            'Team3\Communication\Request\RequestStatus',
            $response->getRequestStatus()
        );
    }
}
