<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer;

use JMS\Serializer\SerializerInterface;
use Team3\Order\Serializer\SerializerInterface as PayUSerializerInterface;
use Team3\Order\Serializer\Adapter\AdapterInterface;

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
     * @param AdapterInterface $adapter
     *
     * @return string
     */
    public function toJson(AdapterInterface $adapter)
    {
        return $this
            ->serializer
            ->serialize(
                $adapter,
                'json'
            );
    }
}
