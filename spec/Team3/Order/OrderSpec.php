<?php

namespace spec\Team3\Order;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OrderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Team3\Order\Order');
    }

    public function it_has_buyer_parameter_initialized()
    {
        $this->getBuyer()->shouldHaveType('Team3\Order\Buyer');
    }

    public function it_has_general_parameter_initialized()
    {
        $this->getGeneral()->shouldHaveType('Team3\Order\General');
    }

    public function it_has_product_collection_parameter_initialized()
    {
        $this->getProductCollection()->shouldHaveType('Team3\Order\ProductCollection');
    }

    public function it_has_shipping_method_collection_parameter_initialized()
    {
        $this->getShippingMethodCollection()->shouldHaveType('Team3\Order\ShippingMethodCollection');
    }

    public function it_has_urls_parameter_initialized()
    {
        $this->getUrls()->shouldHaveType('Team3\Order\Urls');
    }
}
