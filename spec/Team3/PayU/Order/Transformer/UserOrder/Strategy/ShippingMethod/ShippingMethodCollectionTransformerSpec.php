<?php

namespace spec\Team3\PayU\Order\Transformer\UserOrder\Strategy\ShippingMethod;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Team3\PayU\Order\Model\OrderInterface;
use Team3\PayU\Order\Model\ShippingMethods\ShippingMethod;
use Team3\PayU\Order\Model\ShippingMethods\ShippingMethodCollection;
use Team3\PayU\PropertyExtractor\ExtractorInterface;
use Team3\PayU\PropertyExtractor\ExtractorResult;
use Team3\PayU\Order\Transformer\UserOrder\Strategy\ShippingMethod\ShippingMethodCollectionTransformer;
use Team3\PayU\Order\Transformer\UserOrder\Strategy\ShippingMethod\SingleShippingMethodTransformer;

/**
 * Class ShippingMethodCollectionTransformerSpec
 * @package spec\Team3\PayU\Order\Transformer\UserOrder\Strategy\ShippingMethod
 * @mixin ShippingMethodCollectionTransformer
 */
class ShippingMethodCollectionTransformerSpec extends ObjectBehavior
{
    public function let(
        SingleShippingMethodTransformer $singleShippingMethodTransformer
    ) {
        $this->beConstructedWith($singleShippingMethodTransformer);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Team3\PayU\Order\Transformer\UserOrder\Strategy\ShippingMethod\ShippingMethodCollectionTransformer');
    }

    public function it_should_call_helper(
        SingleShippingMethodTransformer $singleShippingMethodTransformer,
        ExtractorResult $extractorResult,
        OrderInterface $order,
        \stdClass $usersShippingMethod
    ) {
        $extractorResult->getValue()->willReturn([$usersShippingMethod]);
        $extractorResult->getValue()->shouldBeCalledTimes(1);
        $order->getShippingMethodCollection()->willReturn(
            new ShippingMethodCollection()
        );
        $order->getShippingMethodCollection()->shouldBeCalledTimes(1);

        $singleShippingMethodTransformer
            ->transform($usersShippingMethod)
            ->willReturn(new ShippingMethod());

        $singleShippingMethodTransformer
            ->transform($usersShippingMethod)
            ->shouldBeCalledTimes(1);

        $this->transform($order, $extractorResult);
    }
}
