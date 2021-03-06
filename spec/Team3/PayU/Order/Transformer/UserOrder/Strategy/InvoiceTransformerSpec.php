<?php

namespace spec\Team3\PayU\Order\Transformer\UserOrder\Strategy;

use PhpSpec\ObjectBehavior;
use Team3\PayU\Order\Model\Buyer\Buyer;
use Team3\PayU\Order\Model\Buyer\BuyerInterface;
use Team3\PayU\Order\Model\Buyer\InvoiceInterface;
use Team3\PayU\Order\Model\OrderInterface;
use Team3\PayU\PropertyExtractor\ExtractorResult;
use Team3\PayU\Order\Transformer\UserOrder\Strategy\InvoiceTransformer;

/**
 * Class InvoiceTransformerSpec
 * @package spec\Team3\PayU\Order\Transformer\UserOrder\Strategy
 * @mixin InvoiceTransformer
 */
class InvoiceTransformerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Team3\PayU\Order\Transformer\UserOrder\Strategy\InvoiceTransformer');
    }

    public function it_supports_certain_param_name()
    {
        $this->supports('invoice.test')->shouldReturn(true);
        $this->supports('wrong-invoice.test')->shouldReturn(false);
        $this->supports('invoice.')->shouldReturn(false);
    }
}
