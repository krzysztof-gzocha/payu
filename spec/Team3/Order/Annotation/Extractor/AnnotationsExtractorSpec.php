<?php

namespace spec\Team3\Order\Annotation\Extractor;

use Doctrine\Common\Annotations\Reader;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Team3\Order\Annotation\Extractor\AnnotationsExtractor;

/**
 * Class AnnotationsExtractorSpec
 * @package spec\Team3\Order\Annotation\Extractor
 * @mixin AnnotationsExtractor
 */
class AnnotationsExtractorSpec extends ObjectBehavior
{
    public function let(Reader $reader)
    {
        $this->beConstructedWith($reader);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Team3\Order\Annotation\Extractor\AnnotationsExtractor');
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
            ->shouldThrow('Team3\\Order\\Annotation\\Extractor\\AnnotationsExtractorException')
            ->during('extractAnnotations', [$variable]);

        return $this;
    }
}
