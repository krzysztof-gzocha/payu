<?php

namespace spec\Team3\Order\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OrderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Team3\Order\Model\Order');
    }

    public function it_has_buyer_parameter_initialized()
    {
        $this->getBuyer()->shouldHaveType('Team3\Order\Model\Buyer');
    }

    public function it_has_general_parameter_initialized()
    {
        $this->getGeneral()->shouldHaveType('Team3\Order\Model\General');
    }

    public function it_has_product_collection_parameter_initialized()
    {
        $this->getProductCollection()->shouldHaveType('Team3\Order\Model\ProductCollection');
    }

    public function it_has_shipping_method_collection_parameter_initialized()
    {
        $this->getShippingMethodCollection()->shouldHaveType('Team3\Order\Model\ShippingMethodCollection');
    }

    public function it_has_urls_parameter_initialized()
    {
        $this->getUrls()->shouldHaveType('Team3\Order\Model\Urls');
    }
}
