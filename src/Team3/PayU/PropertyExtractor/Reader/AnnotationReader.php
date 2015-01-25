<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\PropertyExtractor\Reader;

use Doctrine\Common\Annotations\Reader;
use Psr\Log\LoggerInterface;
use ReflectionClass;
use ReflectionMethod;
use Team3\PayU\Annotation\PayU;
use Team3\PayU\PropertyExtractor\ExtractorException;

class AnnotationReader implements ReaderInterface
{
    const ANNOTATION_CLASS = 'Team3\PayU\Annotation\PayU';

    /**
     * @var Reader
     */
    private $reader;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param Reader          $reader
     * @param LoggerInterface $logger
     */
    public function __construct(
        Reader $reader,
        LoggerInterface $logger
    ) {
        $this->reader = $reader;
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function read($object)
    {
        try {
            $reflectionClass = new ReflectionClass($object);
        } catch (\ReflectionException $exception) {
            throw new ExtractorException(
                $exception->getMessage(),
                $exception->getCode(),
                $exception
            );
        }

        $read = [];

        foreach ($this->getMethods($reflectionClass) as $reflectionMethod) {
            /** @var PayU $methodAnnotation */
            $methodAnnotation = $this
                ->reader
                ->getMethodAnnotation($reflectionMethod, self::ANNOTATION_CLASS);

            if (!is_object($methodAnnotation)) {
                continue;
            }

            $readerResult = new ReaderResult(
                $reflectionMethod->getName(),
                $methodAnnotation->getPropertyName()
            );
            $read[] = $readerResult;
            $this->logReaderResult($readerResult, $object);
        }

        return $read;
    }

    /**
     * @param ReflectionClass $reflectionClass
     *
     * @return ReflectionMethod[]
     */
    private function getMethods(ReflectionClass $reflectionClass)
    {
        return $reflectionClass->getMethods();
    }

    /**
     * @param ReaderResultInterface $readerResult
     * @param object                $object
     */
    private function logReaderResult(
        ReaderResultInterface $readerResult,
        $object
    ) {
        $this
            ->logger
            ->debug(sprintf(
                '%s found result on object %s method %s with property name %s',
                get_class($this),
                get_class($object),
                $readerResult->getMethodName(),
                $readerResult->getPropertyName()
            ));
    }
}
