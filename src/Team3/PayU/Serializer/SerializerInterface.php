<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Serializer;

use JMS\Serializer\SerializationContext;

interface SerializerInterface
{
    /**
     * @param SerializableInterface $serializable
     * @param SerializationContext  $serializationContext
     *
     * @return string
     */
    public function toJson(
        SerializableInterface $serializable,
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
