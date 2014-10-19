<?php

namespace spec\Team3\Order\Serializer\ArrayAdapter\Step;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Team3\Order\Model\Buyer\Buyer;
use Team3\Order\Model\Buyer\BuyerInterface;
use Team3\Order\Model\OrderInterface;
use Team3\Order\Serializer\ArrayAdapter\Step\DeliveryAdapterStep;
use Team3\Order\Serializer\ArrayAdapter\Step\InvoiceAdapterStep;
use Team3\Order\Serializer\ArrayAdapter\Step\SerializableAdapterStepInterface;

class BuyerAdapterStepSpec extends ObjectBehavior
{
    public function let(
        OrderInterface $order,
        BuyerInterface $buyer,
        DeliveryAdapterStep $deliveryAdapterStep,
        InvoiceAdapterStep $invoiceAdapterStep
    ) {
        $order->getBuyer()->willReturn($buyer);

        $buyer->getEmail()->willReturn('test');
        $buyer->getFirstName()->willReturn('test');
        $buyer->getLastName()->willReturn('test');
        $buyer->getPhone()->willReturn('test');

        $deliveryAdapterStep->shouldAdapt($order)->willReturn(true);
        $deliveryAdapterStep->toArray($order)->willReturn([]);

        $invoiceAdapterStep->shouldAdapt($order)->willReturn(true);
        $invoiceAdapterStep->toArray($order)->willReturn([]);


        $this->addAdapterStep($deliveryAdapterStep);
        $this->addAdapterStep($invoiceAdapterStep);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Team3\Order\Serializer\ArrayAdapter\Step\BuyerAdapterStep');
    }

    public function it_should_have_fluent_interface(
        SerializableAdapterStepInterface $adapterStep
    ) {
        $this
            ->addAdapterStep($adapterStep)
            ->shouldImplement('Team3\Order\Serializer\ArrayAdapter\SerializableAdapterInterface');
    }

    public function it_should_call_delivery_step(
        OrderInterface $order,
        DeliveryAdapterStep $deliveryAdapterStep
    ) {
        $deliveryAdapterStep->shouldAdapt($order)->shouldBeCalledTimes(1);
        $deliveryAdapterStep->toArray($order)->shouldBeCalledTimes(1);

        $this->toArray($order);
    }

    public function it_should_call_invoice_step(
        OrderInterface $order,
        InvoiceAdapterStep $invoiceAdapterStep
    ) {
        $invoiceAdapterStep->shouldAdapt($order)->shouldBeCalledTimes(1);
        $invoiceAdapterStep->toArray($order)->shouldBeCalledTimes(1);

        $this->toArray($order);
    }

    public function it_should_call_delivery_step_only_if_allowed(
        OrderInterface $order,
        DeliveryAdapterStep $deliveryAdapterStep
    ) {
        $deliveryAdapterStep->shouldAdapt($order)->willReturn(false);
        $deliveryAdapterStep->toArray($order)->shouldBeCalledTimes(0);

        $this->toArray($order);
    }

    public function it_should_call_invoice_step_only_if_allowed(
        OrderInterface $order,
        InvoiceAdapterStep $invoiceAdapterStep
    ) {
        $invoiceAdapterStep->shouldAdapt($order)->willReturn(false);
        $invoiceAdapterStep->toArray($order)->shouldBeCalledTimes(0);

        $this->toArray($order);
    }
}
