<?php

namespace spec\Team3\PayU\Serializer\Encoder;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;
use Team3\PayU\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;
use Team3\PayU\SignatureCalculator\Encoder\Strategy\EncoderStrategyInterface;

class EncoderSpec extends ObjectBehavior
{
    const ENCODED_STRING = 'encodedString';

    public function let(LoggerInterface $logger)
    {
        $this->beConstructedWith($logger);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Team3\PayU\Serializer\Encoder\Encoder');
    }

    public function it_throws_exception_when_no_strategy_supports_algorithm(
        AlgorithmInterface $algorithm
    ) {
        $data = '123';
        $this->shouldThrow('Team3\PayU\Serializer\Encoder\EncoderException')->during('encode', [$data, $algorithm]);
    }

    public function it_should_call_strategy(
        AlgorithmInterface $algorithm,
        EncoderStrategyInterface $encoderStrategy
    ) {
        $data = '123';
        $encoderStrategy->supports($algorithm)->willReturn(true);
        $encoderStrategy->supports($algorithm)->shouldBeCalledTimes(1);

        $encoderStrategy->encode($data)->willReturn(self::ENCODED_STRING);
        $encoderStrategy->encode($data)->shouldBeCalledTimes(1);

        $this->addStrategy($encoderStrategy);
        $this->encode($data, $algorithm)->shouldReturn(self::ENCODED_STRING);
    }
}
