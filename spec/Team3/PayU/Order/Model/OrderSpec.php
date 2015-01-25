<?php

namespace spec\Team3\PayU\Order\Model;

use PhpSpec\ObjectBehavior;
use Team3\PayU\Order\Model\Order;

/**
 * Class OrderSpec
 * @package spec\Team3\PayU\Order\Model
 * @mixin Order
 */
class OrderSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Team3\PayU\Order\Model\Order');
    }

    public function it_has_buyer_parameter_initialized()
    {
        $this
            ->getBuyer()
            ->shouldImplement('Team3\PayU\Order\Model\Buyer\BuyerInterface');
    }

    public function it_has_product_collection_parameter_initialized()
    {
        $this
            ->getProductCollection()
            ->shouldImplement('Team3\PayU\Order\Model\Products\ProductCollectionInterface');
    }

    public function it_has_shipping_method_collection_parameter_initialized()
    {
        $this
            ->getShippingMethodCollection()
            ->shouldImplement('Team3\PayU\Order\Model\ShippingMethods\ShippingMethodCollectionInterface');
    }
}
