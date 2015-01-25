<?php

namespace spec\Team3\PayU\PropertyExtractor;

use PhpSpec\ObjectBehavior;
use Psr\Log\LoggerInterface;
use Team3\PayU\PropertyExtractor\Extractor;
use Team3\PayU\PropertyExtractor\Reader\ReaderInterface;

/**
 * Class ExtractorSpec
 * @package spec\Team3\PayU\Annotation\Extractor
 * @mixin Extractor
 */
class ExtractorSpec extends ObjectBehavior
{
    public function let(ReaderInterface $reader, LoggerInterface $logger)
    {
        $this->beConstructedWith($reader, $logger);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Team3\PayU\PropertyExtractor\Extractor');
    }

    public function it_should_call_reader(
        ReaderInterface $reader,
        LoggerInterface $logger
    ) {
        $this->beConstructedWith($reader, $logger);
        $model = new \stdClass();
        $reader->read($model)->willReturn([]);
        $reader->read($model)->shouldBeCalled();
        $this->extract($model);
    }

    public function it_check_if_argument_is_an_object()
    {
        $this
            ->exceptionTest(null)
            ->exceptionTest(false)
            ->exceptionTest(2)
            ->exceptionTest(2.4)
            ->exceptionTest([]);
    }

    /**
     * @param mixed $variable
     *
     * @return $this
     */
    protected function exceptionTest($variable)
    {
        $this
            ->shouldThrow('Team3\\PayU\\PropertyExtractor\\ExtractorException')
            ->during('extract', [$variable]);

        return $this;
    }
}
