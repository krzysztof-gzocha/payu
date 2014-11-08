<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\PropertyExtractor;

use Doctrine\Common\Annotations\Reader;
use \ReflectionClass;
use \ReflectionMethod;
use Team3\Order\PropertyExtractor\Reader\ReaderInterface;

class Extractor implements ExtractorInterface
{
    /**
     * @var ReaderInterface
     */
    protected $reader;

    /**
     * @param ReaderInterface $reader
     */
    public function __construct(ReaderInterface $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @param object $object
     *
     * @return array
     */
    public function extract($object)
    {
        $this->checkObject($object);

        $extracted = [];
        $reflectionClass = new ReflectionClass($object);

        foreach ($this->reader->read($object) as $readerResult) {
            $reflectionMethod = $reflectionClass->getMethod($readerResult->getMethodName());
            $reflectionMethod->setAccessible(true);

            $extracted[] = new ExtractorResult(
                $readerResult->getPropertyName(),
                $reflectionMethod->invoke($object)
            );
        }

        return $extracted;
    }

    /**
     * @param $object
     *
     * @throws ExtractorException
     */
    protected function checkObject($object)
    {
        if (!is_object($object)) {
            throw new ExtractorException(sprintf(
                'Given argument should be on object, but "%s" given',
                gettype($object)
            ));
        }
    }
}
