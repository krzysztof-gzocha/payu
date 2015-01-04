<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer;

use JMS\Serializer\SerializerBuilder;
use Psr\Log\LoggerInterface;

class SerializerFactory implements SerializerFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return SerializerInterface
     */
    public function build(LoggerInterface $logger)
    {
        $serializerBuilder = new SerializerBuilder();

        return new Serializer(
            $serializerBuilder->build(),
            new GroupsSpecifier($logger),
            $logger
        );
    }
}
