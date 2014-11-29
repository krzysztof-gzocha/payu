<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PropertyExtractor;

/**
 * Interface ExtractorInterface
 * @package Team3\Order\Annotation\Extractor
 */
interface ExtractorInterface
{
    /**
     * @param object $object
     *
     * @return ExtractorResult[]
     * @throws ExtractorException
     */
    public function extract($object);
}
