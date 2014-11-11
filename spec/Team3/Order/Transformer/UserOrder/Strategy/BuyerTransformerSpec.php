<?php

namespace spec\Team3\Order\Transformer\UserOrder\Strategy;

use PhpSpec\ObjectBehavior;
use Team3\Order\Model\Buyer\BuyerInterface;
use Team3\Order\Model\OrderInterface;
use Team3\Order\PropertyExtractor\ExtractorResult;
use Team3\Order\Transformer\UserOrder\Strategy\BuyerTransformer;

/**
 * Class BuyerTransformerSpec
 * @package spec\Team3\Order\Transformer\UserOrder\Strategy
 * @mixin BuyerTransformer
 */
class BuyerTransformerSpec extends ObjectBehavior
{
    public function let(
        OrderInterface $order,
        BuyerInterface $buyer
    ) {
        $order->getBuyer()->willReturn($buyer);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Team3\Order\Transformer\UserOrder\Strategy\BuyerTransformer');
    }

    public function it_should_support_certain_param_name()
    {
        $this->supports('buyer.test')->shouldReturn(true);

        $this->supports('buyer.')->shouldReturn(false);
        $this->supports('non-buyer.test')->shouldReturn(false);
        $this->supports('something')->shouldReturn(false);
    }

    public function it_should_get_buyer_from_order(
        OrderInterface $order,
        ExtractorResult $extractorResult
    ) {
        $order->getBuyer()->shouldBeCalledTimes(1);

        $this->transform($order, $extractorResult);
    }

    public function it_should_get_value_from_extractor_result(
        OrderInterface $order,
        ExtractorResult $extractorResult
    ) {
        $extractorResult->getPropertyName()->shouldBeCalled();

        $this->transform($order, $extractorResult);
    }
}
