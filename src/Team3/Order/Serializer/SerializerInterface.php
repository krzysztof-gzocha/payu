<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer;

use Team3\Order\Model\OrderInterface;

interface SerializerInterface
{
    /**
     * @param OrderInterface $order
     *
     * @return string
     */
    public function toJson(OrderInterface $order);
}
