<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication;

use Psr\Log\LoggerInterface;
use Team3\PayU\Serializer\SerializerInterface;

interface ClientAdapterFactoryInterface
{
    /**
     * @param SerializerInterface $serializer
     * @param LoggerInterface     $logger
     *
     * @return ClientInterface
     */
    public function build(SerializerInterface $serializer, LoggerInterface $logger);
}
