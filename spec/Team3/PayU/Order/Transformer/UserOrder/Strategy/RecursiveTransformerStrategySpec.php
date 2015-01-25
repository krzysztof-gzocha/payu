<?php

namespace spec\Team3\PayU\Order\Transformer\UserOrder\Strategy;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Team3\PayU\Order\Model\OrderInterface;
use Team3\PayU\PropertyExtractor\ExtractorResult;
use Team3\PayU\Order\Transformer\UserOrder\UserOrderTransformerInterface;

class RecursiveTransformerStrategySpec extends ObjectBehavior
{
    public function let(
        UserOrderTransformerInterface $userOrderTransformer
    ) {
        $this->beConstructedWith($userOrderTransformer);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Team3\PayU\Order\Transformer\UserOrder\Strategy\RecursiveTransformerStrategy');
    }

    public function it_should_pass_value_to_main_transformer(
        UserOrderTransformerInterface $userOrderTransformer,
        OrderInterface $order,
        ExtractorResult $extractorResult,
        \stdClass $extractionValue
    ) {
        $extractorResult
            ->getValue()
            ->willReturn($extractionValue);
        $userOrderTransformer
            ->transform($order, $extractionValue)
            ->shouldBeCalledTimes(1);

        $this->transform($order, $extractorResult);
    }
}
