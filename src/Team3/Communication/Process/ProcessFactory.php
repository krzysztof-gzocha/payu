<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication\Process;

use Buzz\Client\Curl;
use JMS\Serializer\SerializerBuilder;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Team3\Communication\ClientAdapter;
use Team3\Communication\ClientInterface;
use Team3\Communication\CurlRequestBuilder\CurlRequestBuilder;
use Team3\Communication\Response\OrderCreateResponse;
use Team3\Communication\Response\OrderStatusResponse;
use Team3\Communication\Response\ResponseInterface;
use Team3\Order\Serializer\GroupsSpecifier;
use Team3\Order\Serializer\Serializer;
use Team3\Order\Serializer\SerializerInterface;
use Team3\ValidatorBuilder\ValidatorBuilder;

/**
 * Class ProcessFactory
 * @package Team3\Communication\Process
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ProcessFactory implements ProcessFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return RequestProcess
     */
    public function build(LoggerInterface $logger)
    {
        $requestProcess = new RequestProcess(
            $this->getSerializer($logger),
            $this->getClient($logger),
            $this->getValidator()
        );

        return $requestProcess->setResponses($this->getResponses());
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
     * @return SerializerInterface
     */
    private function getSerializer(LoggerInterface $logger)
    {
        $serializerBuilder = new SerializerBuilder();

        return new Serializer(
            $serializerBuilder->build(),
            new GroupsSpecifier($logger),
            $logger
        );
    }

    /**
     * @return ClientInterface
     */
    private function getClient(LoggerInterface $logger)
    {
        return new ClientAdapter(
            new Curl(),
            new CurlRequestBuilder(
                $this->getSerializer($logger)
            ),
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
