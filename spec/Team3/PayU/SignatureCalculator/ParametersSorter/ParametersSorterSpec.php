<?php

namespace spec\Team3\PayU\Serializer\ParametersSorter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Team3\PayU\Order\Model\OrderInterface;
use Team3\PayU\Serializer\SerializerInterface;

class ParametersSorterSpec extends ObjectBehavior
{
    const EXAMPLE_STRING = 'someString';

    public function let(
        SerializerInterface $serializer,
        OrderInterface $order
    ) {
        $serializer->toJson($order)->willReturn(self::EXAMPLE_STRING);
        $serializer->fromJson(self::EXAMPLE_STRING, 'array')->willReturn([]);

        $this->beConstructedWith($serializer);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Team3\PayU\Serializer\ParametersSorter\ParametersSorter');
    }

    public function it_should_return_array(
        OrderInterface $order
    ) {
        $this->getSortedParameters($order)->shouldBeArray();
    }
}
