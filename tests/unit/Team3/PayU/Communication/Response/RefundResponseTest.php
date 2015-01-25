<?php
namespace Team3\PayU\Communication\Response;


use Team3\PayU\Communication\Request\PayURequestInterface;

class RefundResponseTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testSupport()
    {
        $response = new RefundResponse();

        $this->assertTrue($response->supports($this->getRefundRequest()));
        $this->assertFalse($response->supports($this->getAnyOtherRequest()));
    }

    /**
     * @return PayURequestInterface
     */
    private function getRefundRequest()
    {
        return $this
            ->getMockBuilder('\Team3\PayU\Communication\Request\RefundRequest')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return PayURequestInterface
     */
    private function getAnyOtherRequest()
    {
        return $this
            ->getMock('\Team3\PayU\Communication\Request\PayURequestInterface');
    }
}
