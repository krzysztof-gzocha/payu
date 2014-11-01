<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order\Annotation\Extractor;

/**
 * Interface AnnotationsExtractorInterface
 * @package Team3\Order\Annotation\Extractor
 */
interface AnnotationsExtractorInterface
{
    /**
     * @param object $object
     *
     * @return array
     */
    public function extractAnnotations($object);
}
