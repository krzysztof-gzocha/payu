<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer;

use JMS\Serializer\SerializationContext;
use Team3\Order\Model\OrderInterface;

interface SerializerInterface
{
    /**
     * @param OrderInterface       $order
     * @param SerializationContext $serializationContext
     *
     * @return string
     */
    public function toJson(
        OrderInterface $order,
        SerializationContext $serializationContext = null
    );

    /**
     * @param string $data
     * @param string $type
     *
     * @return mixed
     */
    public function fromJson($data, $type);
}
