<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication\Process;

use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Team3\Communication\ClientAdapterFactory;
use Team3\Communication\ClientInterface;
use Team3\Communication\Process\ResponseDeserializer\ResponseDeserializer;
use Team3\Communication\Response\OrderCreateResponse;
use Team3\Communication\Response\OrderStatusResponse;
use Team3\Communication\Response\ResponseInterface;
use Team3\Serializer\SerializerFactory;
use Team3\Serializer\SerializerInterface;
use Team3\ValidatorBuilder\ValidatorBuilder;

/**
 * Class RequestProcessFactory
 * @package Team3\Communication\Process
 */
class RequestProcessFactory implements RequestProcessFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return RequestProcess
     */
    public function build(LoggerInterface $logger)
    {
        $requestProcess = new RequestProcess(
            $this->getDeserializer($logger),
            $this->getClient($logger),
            $this->getValidator()
        );

        return $requestProcess;
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

    /**
     * @param LoggerInterface $logger
     *
     * @return ResponseDeserializer
     */
    private function getDeserializer(LoggerInterface $logger)
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
     * @param LoggerInterface $logger
     *
     * @return ClientInterface
     */
    private function getClient(LoggerInterface $logger)
    {
        $clientAdapterFactory = new ClientAdapterFactory();

        return $clientAdapterFactory->build(
            $this->getSerializer($logger),
            $logger
        );
    }

    /**
     * @return ValidatorInterface
     */
    private function getValidator()
    {
        $validatorBuilder = new ValidatorBuilder();

        return $validatorBuilder->getValidator();
    }
}
