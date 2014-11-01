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
        $this
            ->getBuyer()
            ->shouldImplement('Team3\Order\Model\Buyer\BuyerInterface');
    }

    public function it_has_general_parameter_initialized()
    {
        $this
            ->getGeneral()
            ->shouldImplement('Team3\Order\Model\General\GeneralInterface');
    }

    public function it_has_product_collection_parameter_initialized()
    {
        $this
            ->getProductCollection()
            ->shouldImplement('Team3\Order\Model\Products\ProductCollectionInterface');
    }

    public function it_has_shipping_method_collection_parameter_initialized()
    {
        $this
            ->getShippingMethodCollection()
            ->shouldImplement('Team3\Order\Model\ShippingMethods\ShippingMethodCollectionInterface');
    }

    public function it_has_urls_parameter_initialized()
    {
        $this
            ->getUrls()
            ->shouldImplement('Team3\Order\Model\Urls\Urls');
    }
}
