<?php
namespace Team3\PayU\Order\Transformer\UserOrder\Strategy;


use Team3\PayU\Order\Model\Order;
use Team3\PayU\Order\Transformer\UserOrder\UserOrderTransformerInterface;

class RecursiveTransformerStrategyTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testTransformResult()
    {
        $transformerCalls = 0;
        $recursiveStrategy = new RecursiveTransformerStrategy(
            $this->getUserOrderTransformer($transformerCalls)
        );

        $recursiveStrategy->transform(new Order(), $this->getExtractorResult());

        $this->assertEquals(
            1,
            $transformerCalls
        );
    }

    public function testSupportMethod()
    {
        $transformerCalls = 0;
        $recursiveStrategy = new RecursiveTransformerStrategy(
            $this->getUserOrderTransformer($transformerCalls)
        );

        $this->assertTrue($recursiveStrategy->supports('follow'));
        $this->assertFalse($recursiveStrategy->supports('followa'));
        $this->assertFalse($recursiveStrategy->supports('afollow'));
        $this->assertFalse($recursiveStrategy->supports('something'));
    }

    /**
     * @param int $calls
     *
     * @return UserOrderTransformerInterface
     */
    private function getUserOrderTransformer(&$calls)
    {
        $transformer = $this
            ->getMockBuilder('\Team3\PayU\Order\Transformer\UserOrder\UserOrderTransformerInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $transformer
            ->expects($this->any())
            ->method('transform')
            ->withAnyParameters()
            ->willReturnCallback(function () use (&$calls) {
                $calls++;
            });

        return $transformer;
    }

    /**
     * @return \Team3\PayU\PropertyExtractor\ExtractorResult
     */
    private function getExtractorResult()
    {
        return $this
            ->getMockBuilder('\Team3\PayU\PropertyExtractor\ExtractorResult')
            ->disableOriginalConstructor()
            ->getMock();
    }
}
