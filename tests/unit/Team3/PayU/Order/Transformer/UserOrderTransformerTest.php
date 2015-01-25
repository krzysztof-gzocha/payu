<?php
namespace Team3\PayU\Order\Transformer;

use Team3\PayU\Order\Model\Order;
use Team3\PayU\Order\Model\OrderInterface;
use Team3\PayU\Order\Transformer\UserOrder\Strategy\UserOrderTransformerStrategyInterface;
use Team3\PayU\Order\Transformer\UserOrder\UserOrderTransformer;
use Team3\PayU\PropertyExtractor\ExtractorInterface;
use Team3\PayU\PropertyExtractor\ExtractorResult;

class UserOrderTransformerTest extends \Codeception\TestCase\Test
{
    const ORDER_ID = '123456';

    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testResults()
    {
        $order = new Order();
        $userOrderTransformer = new UserOrderTransformer($this->getExtractor());

        $userOrderTransformer
            ->addStrategy($this->getStrategy($order));

        $returnedOrder = $userOrderTransformer->transform($order, new \stdClass());

        $this->assertInstanceOf(
            'Team3\PayU\Order\Model\OrderInterface',
            $returnedOrder
        );

        $this->assertEquals(
            self::ORDER_ID,
            $order->getOrderId()
        );

        $this->assertEquals(
            $returnedOrder->getOrderId(),
            $order->getOrderId()
        );
    }

    /**
     * @return ExtractorInterface
     */
    private function getExtractor()
    {
        $extractor = $this
            ->getMock('\Team3\PayU\PropertyExtractor\ExtractorInterface');

        $extractor
            ->expects($this->any())
            ->method('extract')
            ->withAnyParameters()
            ->willReturn([$this->getExtractorResult()]);

        return $extractor;
    }

    /**
     * @return ExtractorResult
     */
    private function getExtractorResult()
    {
        $extractorResult = $this
            ->getMockBuilder('\Team3\PayU\PropertyExtractor\ExtractorResult')
            ->disableOriginalConstructor()
            ->getMock();

        return $extractorResult;
    }

    /**
     * @param OrderInterface $order
     *
     * @return UserOrderTransformerStrategyInterface
     */
    private function getStrategy(OrderInterface $order)
    {
        $strategy = $this
            ->getMock('\Team3\PayU\Order\Transformer\UserOrder\Strategy\UserOrderTransformerStrategyInterface');

        $strategy
            ->expects($this->any())
            ->method('supports')
            ->withAnyParameters()
            ->willReturn(true);

        $strategy
            ->expects($this->any())
            ->method('transform')
            ->willReturnCallback(function (OrderInterface $order, $extractorResult) use ($order) {
                $order->setOrderId(self::ORDER_ID);
            });

        return $strategy;
    }
}
