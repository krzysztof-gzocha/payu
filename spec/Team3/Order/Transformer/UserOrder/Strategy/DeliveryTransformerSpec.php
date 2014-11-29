<?php

namespace spec\Team3\Order\Transformer\UserOrder\Strategy;

use PhpSpec\ObjectBehavior;
use Team3\Order\Model\Buyer\BuyerInterface;
use Team3\Order\Model\Buyer\DeliveryInterface;
use Team3\Order\Model\OrderInterface;
use Team3\PropertyExtractor\ExtractorResult;
use Team3\Order\Transformer\UserOrder\Strategy\DeliveryTransformer;

/**
 * Class DeliveryTransformerSpec
 * @package spec\Team3\Order\Transformer\UserOrder\Strategy
 * @mixin DeliveryTransformer
 */
class DeliveryTransformerSpec extends ObjectBehavior
{
    public function let(
        OrderInterface $order,
        BuyerInterface $buyer,
        DeliveryInterface $delivery
    ) {
        $order->getBuyer()->willReturn($buyer);
        $buyer->getDelivery()->willReturn($delivery);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Team3\Order\Transformer\UserOrder\Strategy\DeliveryTransformer');
    }

    public function it_should_supports_only_certain_parameters()
    {
        $this->supports('delivery.test')->shouldReturn(true);

        $this->supports('non-delivery.test')->shouldReturn(false);
        $this->supports('delivery.')->shouldReturn(false);
        $this->supports('delivery')->shouldReturn(false);
    }

    public function it_should_get_delivery_from_order(
        OrderInterface $order,
        BuyerInterface $buyer,
        ExtractorResult $extractorResult
    ) {
        $buyer->getDelivery()->shouldBeCalled();
        $this->transform($order, $extractorResult);
    }

    public function it_should_get_property_name_from_extractor(
        OrderInterface $order,
        ExtractorResult $extractorResult
    ) {
        $extractorResult->getPropertyName()->shouldBeCalled();
        $this->transform($order, $extractorResult);
    }
}
