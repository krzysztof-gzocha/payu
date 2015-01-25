<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\PropertyExtractor;

use Psr\Log\LoggerInterface;
use ReflectionClass;
use ReflectionException;
use Team3\PayU\PropertyExtractor\Reader\ReaderInterface;

class Extractor implements ExtractorInterface
{
    /**
     * @var ReaderInterface
     */
    protected $reader;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param ReaderInterface $reader
     * @param LoggerInterface $logger
     */
    public function __construct(
        ReaderInterface $reader,
        LoggerInterface $logger
    ) {
        $this->reader = $reader;
        $this->logger = $logger;
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
    private function processExtraction($object)
    {
        $extracted = [];
        $reflectionClass = new ReflectionClass($object);

        foreach ($this->reader->read($object) as $readerResult) {
            $reflectionMethod = $reflectionClass->getMethod($readerResult->getMethodName());
            $reflectionMethod->setAccessible(true);

            $extractorResult = new ExtractorResult(
                $readerResult->getPropertyName(),
                $reflectionMethod->invoke($object)
            );
            $extracted[] = $extractorResult;

            $this->logExtractedResult($extractorResult, $object);
        }

        return $extracted;
    }

    /**
     * @param \Exception $exception
     *
     * @return ExtractorException
     */
    private function adaptException(\Exception $exception)
    {
        $this
            ->logger
            ->error(sprintf(
                'Exception %s was throw during extracting properties. Message: "%s"',
                get_class($exception),
                $exception->getMessage()
            ));

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
    private function checkClass($class)
    {
        if (!is_object($class)) {
            $message = sprintf(
                'Given argument should be on object, but "%s" given',
                gettype($class)
            );
            $this
                ->logger
                ->error($message);
            throw new ExtractorException($message);
        }
    }

    /**
     * @param ExtractorResult $extractorResult
     * @param object          $object
     */
    private function logExtractedResult(ExtractorResult $extractorResult, $object)
    {
        $this
            ->logger
            ->debug(sprintf(
                'Successfully extracted parameter %s with value "%s" from object %s',
                $extractorResult->getPropertyName(),
                print_r($extractorResult->getValue(), true),
                get_class($object)
            ));
    }
}
