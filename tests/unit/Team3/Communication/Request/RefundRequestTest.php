<?php
namespace Team3\Communication\Request;


use Team3\Communication\Request\Model\RefundRequestModel;

class RefundRequestTest extends \Codeception\TestCase\Test
{
    const ORDER_ID = '123456';

    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testSettings()
    {
        $refundRequest = new RefundRequest($this->getRefundRequestModel());

        $this->assertEquals(
            PayURequestInterface::METHOD_POST,
            $refundRequest->getMethod()
        );

        $this->assertEquals(
            sprintf('orders/%s/refund', self::ORDER_ID),
            $refundRequest->getPath()
        );

        $this->assertInstanceOf(
            '\Team3\Communication\Request\Model\RefundRequestModel',
            $refundRequest->getDataObject()
        );
    }

    /**
     * @return RefundRequestModel
     */
    private function getRefundRequestModel()
    {
        $requestModel = $this
            ->getMockBuilder('\Team3\Communication\Request\Model\RefundRequestModel')
            ->disableOriginalConstructor()
            ->getMock();

        $requestModel
            ->expects($this->any())
            ->method('getOrderId')
            ->willReturn(self::ORDER_ID);

        return $requestModel;
    }
}
