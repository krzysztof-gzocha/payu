<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PropertyExtractor\Reader;

use Doctrine\Common\Annotations\Reader;
use ReflectionClass;
use ReflectionMethod;
use Team3\Order\Annotation\PayU;
use Team3\PropertyExtractor\ExtractorException;

class AnnotationReader implements ReaderInterface
{
    const ANNOTATION_CLASS = 'Team3\Order\Annotation\PayU';
    /**
     * @var Reader
     */
    private $reader;

    /**
     * @param Reader $reader
     */
    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
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

            if (is_object($methodAnnotation)) {
                $read[] = new ReaderResult(
                    $reflectionMethod->getName(),
                    $methodAnnotation->getPropertyName()
                );
            }
        }

        return $read;
    }

    /**
     * @param ReflectionClass $reflectionClass
     *
     * @return ReflectionMethod[]
     */
    protected function getMethods(ReflectionClass $reflectionClass)
    {
        return $reflectionClass->getMethods();
    }
}
