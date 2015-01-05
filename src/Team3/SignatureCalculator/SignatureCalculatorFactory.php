<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\SignatureCalculator;

use Psr\Log\LoggerInterface;
use Team3\Serializer\SerializerFactory;
use Team3\SignatureCalculator\Encoder\EncoderFactory;
use Team3\SignatureCalculator\Encoder\EncoderInterface;
use Team3\SignatureCalculator\ParametersSorter\ParametersSorter;

class SignatureCalculatorFactory implements SignatureCalculatorFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return SignatureCalculatorInterface
     */
    public function build(LoggerInterface $logger)
    {
        return new SignatureCalculator(
            $this->getParametersSorter($logger),
            $this->getEncoder($logger),
            $logger
        );
    }

    private function getSerializer(LoggerInterface $logger)
    {
        $serializerFactory = new SerializerFactory();

        return $serializerFactory->build($logger);
    }

    /**
     * @param LoggerInterface $logger
     *
     * @return EncoderInterface
     */
    private function getEncoder(LoggerInterface $logger)
    {
        $encoderFactory = new EncoderFactory();

        return $encoderFactory->build($logger);
    }

    /**
     * @param LoggerInterface $logger
     *
     * @return ParametersSorter
     */
    private function getParametersSorter(LoggerInterface $logger)
    {
        return new ParametersSorter($this->getSerializer($logger));
    }
}
