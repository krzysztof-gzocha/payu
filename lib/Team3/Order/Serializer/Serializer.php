<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer;

class Serializer
{
    /**
     * @param \JsonSerializable $jsonSerializable
     *
     * @return string
     */
    public function serialize(\JsonSerializable $jsonSerializable)
    {
        return json_encode($jsonSerializable);
    }
}
