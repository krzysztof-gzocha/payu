<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\PropertyExtractor;

use Psr\Log\LoggerInterface;

interface PropertyExtractorFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return Extractor
     */
    public function build(LoggerInterface $logger);
}
