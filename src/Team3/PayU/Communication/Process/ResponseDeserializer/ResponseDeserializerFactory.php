<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\Communication\Process\ResponseDeserializer;

use Psr\Log\LoggerInterface;
use Team3\PayU\Communication\Response\OrderCreateResponse;
use Team3\PayU\Communication\Response\OrderStatusResponse;
use Team3\PayU\Communication\Response\ResponseInterface;
use Team3\PayU\Serializer\SerializerFactory;
use Team3\PayU\Serializer\SerializerInterface;

class ResponseDeserializerFactory implements ResponseDeserializerFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return ResponseDeserializer
     */
    public function build(LoggerInterface $logger)
    {
        $deserializer = new ResponseDeserializer($this->getSerializer($logger));
        $deserializer->setResponses($this->getResponses());

        return $deserializer;
    }

    /**
     * @param LoggerInterface $logger
     *
     * @return SerializerInterface
     */
    private function getSerializer(LoggerInterface $logger)
    {
        $serializerFactory = new SerializerFactory();

        return $serializerFactory->build($logger);
    }

    /**
     * @return ResponseInterface[]
     */
    private function getResponses()
    {
        return [
            new OrderCreateResponse(),
            new OrderStatusResponse()
        ];
    }
}
