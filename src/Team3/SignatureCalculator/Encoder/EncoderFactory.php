<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\SignatureCalculator\Encoder;

use Psr\Log\LoggerInterface;
use Team3\SignatureCalculator\Encoder\Strategy\EncoderStrategyInterface;
use Team3\SignatureCalculator\Encoder\Strategy\Md5Strategy;
use Team3\SignatureCalculator\Encoder\Strategy\Sha1Strategy;
use Team3\SignatureCalculator\Encoder\Strategy\Sha256Strategy;

class EncoderFactory implements EncoderFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return EncoderInterface
     */
    public function build(LoggerInterface $logger)
    {
        $encoder = new Encoder($logger);
        foreach ($this->getStrategies() as $strategy) {
            $encoder->addStrategy($strategy);
        }

        return $encoder;
    }

    /**
     * @return EncoderStrategyInterface
     */
    public function getStrategies()
    {
        return [
            new Md5Strategy(),
            new Sha1Strategy(),
            new Sha256Strategy()
        ];
    }
}
