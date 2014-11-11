<?php

namespace spec\Team3\Order\Transformer\UserOrder\Strategy;

use PhpSpec\ObjectBehavior;
use Team3\Order\Model\OrderInterface;
use Team3\Order\PropertyExtractor\ExtractorResult;
use Team3\Order\Transformer\UserOrder\Strategy\InvoiceInSeparateEntityTransformer;
use Team3\Order\Transformer\UserOrder\UserOrderTransformerInterface;

/**
 * Class InvoiceInSeparateEntityTransformerTestSpec
 * @package spec\Team3\Order\Transformer\UserOrder\Strategy
 * @mixin InvoiceInSeparateEntityTransformer
 */
class InvoiceInSeparateEntityTransformerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Team3\Order\Transformer\UserOrder\Strategy\InvoiceInSeparateEntityTransformer');
    }

    public function it_should_call_main_transformer(
        UserOrderTransformerInterface $transformer,
        OrderInterface $order,
        \stdClass $separateModel,
        ExtractorResult $extractorResult
    ) {
        $extractorResult->getValue()->willReturn($separateModel);
        $this->setMainTransformer($transformer);
        $transformer->transform($order, $separateModel)->shouldBeCalledTimes(1);

        $this->transform($order, $extractorResult);
    }
}
