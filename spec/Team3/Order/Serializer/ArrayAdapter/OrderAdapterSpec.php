<?php

namespace spec\Team3\Order\Serializer\ArrayAdapter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Team3\Order\Model\OrderInterface;
use Team3\Order\Serializer\ArrayAdapter\Step\SerializableAdapterStepInterface;

class OrderAdapterSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Team3\Order\Serializer\ArrayAdapter\OrderAdapter');
    }

    public function it_should_have_fluent_interface(
        SerializableAdapterStepInterface $adapterStep
    ) {
        $this
            ->addAdapterStep($adapterStep)
            ->shouldImplement('Team3\Order\Serializer\ArrayAdapter\SerializableAdapterInterface');
    }

    public function it_should_call_every_step_once(
        SerializableAdapterStepInterface $adapterStep1,
        SerializableAdapterStepInterface $adapterStep2,
        OrderInterface $order
    ) {
        $this
            ->addAdapterStep($adapterStep1)
            ->addAdapterStep($adapterStep2);

        $adapterStep1->shouldAdapt($order)->shouldBeCalledTimes(1);
        $adapterStep2->shouldAdapt($order)->shouldBeCalledTimes(1);
        $adapterStep1->toArray($order)->shouldBeCalledTimes(1);
        $adapterStep2->toArray($order)->shouldBeCalledTimes(1);

        $adapterStep1->shouldAdapt($order)->willReturn(true);
        $adapterStep2->shouldAdapt($order)->willReturn(true);
        $adapterStep1->toArray($order)->willReturn([]);
        $adapterStep2->toArray($order)->willReturn([]);

        $this->toArray($order);
    }
}
