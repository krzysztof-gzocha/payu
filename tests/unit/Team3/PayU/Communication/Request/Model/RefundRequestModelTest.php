<?php
namespace Team3\PayU\Communication\Request\Model;

use Psr\Log\LoggerInterface;
use Team3\PayU\Order\Model\Money\Money;
use Team3\PayU\Order\Model\OrderInterface;
use Team3\PayU\Serializer\SerializerFactory;
use Team3\PayU\Serializer\SerializerInterface;

class RefundRequestModelTest extends \Codeception\TestCase\Test
{
    const ORDER_ID = 123456;
    const REFUND_DESC = 'Refund';
    const AMOUNT_VALUE = 12.34;
    const AMOUNT_VALUE_WITHOUT_SEPARATION = 1234;

    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    protected function _before()
    {
        $serializerFactory = new SerializerFactory();
        $this->serializer = $serializerFactory->build($this->getLogger());
    }

    public function testSerializedModelWithoutAmount()
    {
        $requestModel = new RefundRequestModel($this->getOrder(), self::REFUND_DESC);
        $serialized = $this->serializer->toJson($requestModel);

        $this->assertEquals(
            '{"order_id":"123456","refund":{"description":"Refund"}}',
            $serialized
        );
    }

    public function testSerializedModelWithAmount()
    {
        $requestModel = new RefundRequestModel(
            $this->getOrder(),
            self::REFUND_DESC,
            self::REFUND_DESC,
            new Money(self::AMOUNT_VALUE)
        );
        $serialized = $this->serializer->toJson($requestModel);

        $this->assertEquals(
            sprintf(
                '{"order_id":"123456","refund":{"amount":1234,"bank_description":"Refund","description":"Refund"}}',
                self::AMOUNT_VALUE_WITHOUT_SEPARATION
            ),
            $serialized
        );
    }

    public function testWithoutAmount()
    {
        $requestModel = new RefundRequestModel($this->getOrder(), self::REFUND_DESC);
        $this->assertInstanceOf(
            '\Team3\PayU\Communication\Request\Model\RefundModelInterface',
            $requestModel->getRefund()
        );
        $this->assertEquals(
            self::REFUND_DESC,
            $requestModel->getRefund()->getDescription()
        );
        $this->assertNull(
            $requestModel->getRefund()->getAmount()
        );
        $this->assertEquals(
            self::ORDER_ID,
            $requestModel->getOrderId()
        );
    }

    public function testWithAmount()
    {
        $requestModel = new RefundRequestModel(
            $this->getOrder(),
            self::REFUND_DESC,
            self::REFUND_DESC,
            new Money(self::AMOUNT_VALUE)
        );
        $this->assertInstanceOf(
            '\Team3\PayU\Communication\Request\Model\RefundModelInterface',
            $requestModel->getRefund()
        );
        $this->assertEquals(
            self::REFUND_DESC,
            $requestModel->getRefund()->getDescription()
        );
        $this->assertEquals(
            self::AMOUNT_VALUE,
            $requestModel->getRefund()->getAmount()->getValue()
        );
        $this->assertEquals(
            self::ORDER_ID,
            $requestModel->getOrderId()
        );
    }

    /**
     * @return LoggerInterface
     */
    private function getLogger()
    {
        return $this->getMock('\Psr\Log\LoggerInterface');
    }

    /**
     * @return OrderInterface
     */
    private function getOrder()
    {
        $order = $this->getMock('\Team3\PayU\Order\Model\OrderInterface');
        $order
            ->expects($this->any())
            ->method('getOrderId')
            ->willReturn(self::ORDER_ID);

        return $order;
    }
}
