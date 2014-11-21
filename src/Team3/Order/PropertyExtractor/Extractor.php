<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\PropertyExtractor;

use \ReflectionClass;
use \ReflectionException;
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
     * @return ExtractorResult[]
     * @throws ExtractorException
     */
    public function extract($object)
    {
        $extracted = [];
        try {
            $reflectionClass = new ReflectionClass($object);
        } catch (ReflectionException $exception) {
            throw $this->adaptException($exception);
        }

        foreach ($this->reader->read($object) as $readerResult) {
            try {
                $reflectionMethod = $reflectionClass->getMethod($readerResult->getMethodName());
                $reflectionMethod->setAccessible(true);

                $extracted[] = new ExtractorResult(
                    $readerResult->getPropertyName(),
                    $reflectionMethod->invoke($object)
                );
            } catch (ReflectionException $exception) {
                throw $this->adaptException($exception);
            }
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
}
