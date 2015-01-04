<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order\Serializer;

use Psr\Log\LoggerInterface;

interface SerializerFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return SerializerInterface
     */
    public function build(LoggerInterface $logger);
}
