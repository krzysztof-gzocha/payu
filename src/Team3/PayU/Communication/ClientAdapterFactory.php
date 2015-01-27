<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication;

use Buzz\Client\Curl;
use Psr\Log\LoggerInterface;
use Team3\PayU\Communication\CurlRequestBuilder\CurlRequestBuilder;
use Team3\PayU\Serializer\SerializerInterface;

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
