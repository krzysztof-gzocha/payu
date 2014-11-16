<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer;

use JMS\Serializer\SerializerInterface;
use Team3\Order\Model\OrderInterface;
use Team3\Order\Serializer\Adapter\OrderAdapter;

class Serializer
{
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @param SerializerInterface $serializer
     */
    public function __construct(
        SerializerInterface $serializer
    ) {
        $this->serializer = $serializer;
    }

    /**
     * @param OrderInterface $order
     *
     * @return string
     */
    public function toJson(
        OrderInterface $order
    ) {
        return $this
            ->serializer
            ->serialize(
                $this->getOrderAdapter($order),
                'json'
            );
    }

    /**
     * @param OrderInterface $order
     *
     * @return OrderAdapter
     */
    private function getOrderAdapter(OrderInterface $order)
    {
        return new OrderAdapter($order);
    }
}
