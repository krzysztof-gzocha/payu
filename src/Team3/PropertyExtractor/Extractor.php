<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PropertyExtractor;

use ReflectionClass;
use ReflectionException;
use Team3\PropertyExtractor\Reader\ReaderInterface;

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
     * @return ExtractorResult[]
     * @throws ExtractorException
     */
    public function extract($object)
    {
        $this->checkClass($object);

        try {
            return $this->processExtraction($object);
        } catch (ReflectionException $exception) {
            throw $this->adaptException($exception);
        }
    }

    /**
     * @param $object
     *
     * @return ExtractorResult[]
     */
    protected function processExtraction($object)
    {
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
     * @param \Exception $exception
     *
     * @return ExtractorException
     */
    protected function adaptException(\Exception $exception)
    {
        return new ExtractorException(
            $exception->getMessage(),
            $exception->getCode(),
            $exception
        );
    }

    /**
     * @param $class
     *
     * @throws ExtractorException
     */
    protected function checkClass($class)
    {
        if (!is_object($class)) {
            throw new ExtractorException(sprintf(
                'Given argument should be on object, but "%s" given',
                gettype($class)
            ));
        }
    }
}
