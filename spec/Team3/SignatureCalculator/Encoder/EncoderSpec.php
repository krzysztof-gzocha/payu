<?php

namespace spec\Team3\SignatureCalculator\Encoder;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Team3\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;
use Team3\SignatureCalculator\Encoder\Strategy\EncoderStrategyInterface;

class EncoderSpec extends ObjectBehavior
{
    const ENCODED_STRING = 'encodedString';

    public function it_is_initializable()
    {
        $this->shouldHaveType('Team3\SignatureCalculator\Encoder\Encoder');
    }

    public function it_throws_exception_when_no_strategy_supports_algorithm(
        $data,
        AlgorithmInterface $algorithm
    ) {
        $this->shouldThrow('Team3\SignatureCalculator\Encoder\EncoderException')->during('encode', [$data, $algorithm]);
    }

    public function it_should_call_strategy(
        $data,
        AlgorithmInterface $algorithm,
        EncoderStrategyInterface $encoderStrategy
    ) {
        $encoderStrategy->supports($algorithm)->willReturn(true);
        $encoderStrategy->supports($algorithm)->shouldBeCalledTimes(1);

        $encoderStrategy->encode($data)->willReturn(self::ENCODED_STRING);
        $encoderStrategy->encode($data)->shouldBeCalledTimes(1);

        $this->addStrategy($encoderStrategy);
        $this->encode($data, $algorithm)->shouldReturn(self::ENCODED_STRING);
    }
}
