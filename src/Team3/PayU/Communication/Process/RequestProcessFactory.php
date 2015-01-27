<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Process;

use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Team3\PayU\Communication\ClientAdapterFactory;
use Team3\PayU\Communication\ClientInterface;
use Team3\PayU\Communication\HttpStatusParser\HttpStatusParser;
use Team3\PayU\Communication\Process\ResponseDeserializer\ResponseDeserializer;
use Team3\PayU\Communication\Process\ResponseDeserializer\ResponseDeserializerFactory;
use Team3\PayU\Serializer\SerializerFactory;
use Team3\PayU\Serializer\SerializerInterface;
use Team3\PayU\ValidatorBuilder\ValidatorBuilder;

/**
 * Class RequestProcessFactory
 * @package Team3\PayU\Communication\Process
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
            $this->getValidator(),
            new HttpStatusParser()
        );

        return $requestProcess;
    }

    /**
     * @param LoggerInterface $logger
     *
     * @return ResponseDeserializer
     */
    private function getDeserializer(LoggerInterface $logger)
    {
        $deserializerFactory = new ResponseDeserializerFactory();

        return $deserializerFactory->build($logger);
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
