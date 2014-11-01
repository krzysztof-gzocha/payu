<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Annotation\Extractor;

use \ReflectionMethod;
use Team3\Order\Annotation\PayU;

/**
 * Class AnnotationsExtractorResult
 * @package Team3\Order\Annotation\Extractor
 */
class AnnotationsExtractorResult
{
    /**
     * @var ReflectionMethod
     */
    protected $reflectionMethod;

    /**
     * @var PayU
     */
    protected $annotation;

    /**
     * @param PayU             $annotation
     * @param ReflectionMethod $reflectionMethod
     */
    public function __construct(
        PayU $annotation,
        ReflectionMethod $reflectionMethod
    ) {
        $this->annotation = $annotation;
        $this->reflectionMethod = $reflectionMethod;
    }

    /**
     * @return PayU
     */
    public function getAnnotation()
    {
        return $this->annotation;
    }

    /**
     * @return ReflectionMethod
     */
    public function getReflectionMethod()
    {
        return $this->reflectionMethod;
    }
}
