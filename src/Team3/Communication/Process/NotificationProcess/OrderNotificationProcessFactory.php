<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication\Process\NotificationProcess;

use Psr\Log\LoggerInterface;
use Team3\Serializer\SerializerFactory;
use Team3\Serializer\SerializerInterface;
use Team3\SignatureCalculator\Encoder\Algorithms\AlgorithmsProvider;
use Team3\SignatureCalculator\Encoder\EncoderFactory;
use Team3\SignatureCalculator\SignatureCalculator;
use Team3\SignatureCalculator\Validator\AlgorithmExtractor;
use Team3\SignatureCalculator\Validator\SignatureValidator;

class OrderNotificationProcessFactory implements OrderNotificationProcessFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return OrderNotificationProcess
     */
    public function build(LoggerInterface $logger)
    {
        return new OrderNotificationProcess(
            $this->getSerializer($logger),
            $this->getSignatureValidator($logger),
            new AlgorithmsProvider()
        );
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
     * @return SignatureValidator
     */
    private function getSignatureValidator(LoggerInterface $logger)
    {
        $encoderFactory = new EncoderFactory();

        return new SignatureValidator(
            new SignatureCalculator($encoderFactory->build($logger)),
            new AlgorithmExtractor(),
            new AlgorithmsProvider()
        );
    }
}
