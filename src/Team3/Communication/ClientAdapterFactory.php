<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication;

use Buzz\Client\Curl;
use Psr\Log\LoggerInterface;
use Team3\Communication\CurlRequestBuilder\CurlRequestBuilder;
use Team3\Order\Serializer\SerializerInterface;

class ClientAdapterFactory implements ClientAdapterFactoryInterface
{
    /**
     * @param SerializerInterface $serializer
     * @param LoggerInterface     $logger
     *
     * @return ClientInterface
     */
    public function build(
        SerializerInterface $serializer,
        LoggerInterface $logger
    ) {
        return new ClientAdapter(
            new Curl(),
            new CurlRequestBuilder($serializer),
            $logger
        );
    }
}
