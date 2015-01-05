<?php

namespace spec\Team3\SignatureCalculator\ParametersSorter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Team3\Order\Model\OrderInterface;
use Team3\Serializer\SerializerInterface;

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
        $this->shouldHaveType('Team3\SignatureCalculator\ParametersSorter\ParametersSorter');
    }

    public function it_should_return_array(
        OrderInterface $order
    ) {
        $this->getSortedParameters($order)->shouldBeArray();
    }
}
