<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\PropertyExtractor;

/**
 * This class will extract parameters from given object and return them as an array of {@link ExtractorResult}
 *
 * Interface ExtractorInterface
 * @package Team3\PayU\Annotation\Extractor
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
