<?php

namespace spec\Team3\PayU\Order\Model\Buyer;

use PhpSpec\ObjectBehavior;

class BuyerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Team3\PayU\Order\Model\Buyer\Buyer');
    }

    public function it_is_initialized_with_delivery()
    {
        $this->getDelivery()->shouldImplement('Team3\PayU\Order\Model\Buyer\DeliveryInterface');
    }

    public function it_is_initialized_with_invoice()
    {
        $this->getInvoice()->shouldImplement('Team3\PayU\Order\Model\Buyer\InvoiceInterface');
    }
}
