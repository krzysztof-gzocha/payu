<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication\RequestBuilder;

use Team3\Communication\Request\OrderCreateRequest;
use Team3\Order\Model\OrderInterface;
use Team3\Order\Serializer\SerializerInterface;

class CreateOrderRequestBuilder implements RequestBuilderInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param OrderInterface $order
     *
     * @return OrderCreateRequest
     */
    public function build(OrderInterface $order)
    {
        return new OrderCreateRequest(
            $this->serializer->toJson($order)
        );
    }
}
