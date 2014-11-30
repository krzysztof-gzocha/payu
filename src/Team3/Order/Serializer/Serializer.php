<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer;

use JMS\Serializer\SerializerInterface;
use Team3\Order\Model\OrderInterface;
use Team3\Order\Serializer\SerializerInterface as PayUSerializerInterface;

class Serializer implements PayUSerializerInterface
{
    /**
     * @var SerializerInterface
     */
    protected $serializer;

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
     * @return string
     */
    public function toJson(OrderInterface $order)
    {
        return $this
            ->serializer
            ->serialize(
                $order,
                'json'
            );
    }

    /**
     * @param string $data
     * @param string $type
     *
     * @return object
     */
    public function fromJson($data, $type)
    {
        return $this
            ->serializer
            ->deserialize(
                $data,
                $type,
                'json'
            );
    }
}
