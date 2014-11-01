<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Annotation\Extractor;

use Doctrine\Common\Annotations\Reader;
use \ReflectionClass;
use \ReflectionMethod;
use Team3\Order\Annotation\PayU;

class AnnotationsExtractor implements AnnotationsExtractorInterface
{
    /**
     * @var Reader
     */
    protected $annotationReader;

    /**
     * @param Reader $reader
     */
    public function __construct(Reader $reader)
    {
        $this->annotationReader = $reader;
    }

    /**
     * @param object $object
     *
     * @return array
     */
    public function extractAnnotations($object)
    {
        $this->checkObject($object);
        $extracted = [];
        $reflectionClass = new ReflectionClass($object);

        foreach ($this->getMethods($reflectionClass) as $reflectionMethod) {
            /** @var PayU $methodAnnotation */
            $methodAnnotation = $this
                ->annotationReader
                ->getMethodAnnotation($reflectionMethod, PayU::class);

            if (is_object($methodAnnotation)) {
                $extracted[] = new AnnotationsExtractorResult($methodAnnotation, $reflectionMethod);
            }
        }

        return $extracted;
    }

    /**
     * @param $object
     *
     * @throws AnnotationsExtractorException
     */
    protected function checkObject($object)
    {
        if (!is_object($object)) {
            throw new AnnotationsExtractorException(sprintf(
                'Given argument should be on object, but "%s" given',
                gettype($object)
            ));
        }
    }

    /**
     * @param ReflectionClass $reflectionClass
     *
     * @return ReflectionMethod[]
     */
    protected function getMethods(ReflectionClass $reflectionClass)
    {
        return $reflectionClass->getMethods(ReflectionMethod::IS_PUBLIC);
    }
}
