<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer;

use Team3\Order\Serializer\Adapter\AdapterInterface;

interface SerializerInterface
{
    /**
     * @param AdapterInterface $adapter
     *
     * @return string
     */
    public function toJson(AdapterInterface $adapter);
}
