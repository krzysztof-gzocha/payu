<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\Communication\Process\NotificationProcess;

use Psr\Log\LoggerInterface;
use Team3\PayU\Serializer\SerializerFactory;
use Team3\PayU\Serializer\SerializerInterface;
use Team3\PayU\SignatureCalculator\Encoder\Algorithms\AlgorithmsProvider;
use Team3\PayU\SignatureCalculator\Encoder\EncoderFactory;
use Team3\PayU\SignatureCalculator\SignatureCalculator;
use Team3\PayU\SignatureCalculator\Validator\AlgorithmExtractor;
use Team3\PayU\SignatureCalculator\Validator\SignatureValidator;

class NotificationProcessFactory implements NotificationProcessFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return NotificationProcess
     */
    public function build(LoggerInterface $logger)
    {
        return new NotificationProcess(
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
