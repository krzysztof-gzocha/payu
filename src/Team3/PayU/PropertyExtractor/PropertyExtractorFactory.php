<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\PropertyExtractor;

use Psr\Log\LoggerInterface;
use Team3\PayU\PropertyExtractor\Reader\AnnotationReader;
use Team3\PayU\PropertyExtractor\Reader\ReaderInterface;
use Doctrine\Common\Annotations\AnnotationReader as DoctrineAnnotationReader;

class PropertyExtractorFactory implements PropertyExtractorFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return Extractor
     */
    public function build(LoggerInterface $logger)
    {
        return new Extractor(
            $this->getReader($logger),
            $logger
        );
    }

    /**
     * @param  LoggerInterface $logger
     * @return ReaderInterface
     */
    private function getReader(LoggerInterface $logger)
    {
        return new AnnotationReader(
            new DoctrineAnnotationReader(),
            $logger
        );
    }
}
