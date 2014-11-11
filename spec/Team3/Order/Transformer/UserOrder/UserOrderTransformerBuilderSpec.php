<?php

namespace spec\Team3\Order\Transformer\UserOrder;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Team3\Order\PropertyExtractor\ExtractorInterface;

class UserOrderTransformerBuilderSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Team3\Order\Transformer\UserOrder\UserOrderTransformerBuilder');
    }

    public function it_should_return_transformer(
        ExtractorInterface $extractor
    ) {
        $this
            ->build($extractor)
            ->shouldHaveType('Team3\Order\Transformer\UserOrder\UserOrderTransformer');
    }
}
