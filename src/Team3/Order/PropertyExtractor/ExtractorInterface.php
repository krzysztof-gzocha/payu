<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order\PropertyExtractor;

/**
 * Interface ExtractorInterface
 * @package Team3\Order\Annotation\Extractor
 */
interface ExtractorInterface
{
    /**
     * @param object $object
     *
     * @return ExtractorInterface
     */
    public function extract($object);
}
