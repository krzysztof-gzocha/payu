<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\PropertyExtractor\Reader;

/**
 * This class is holding property name and method on which it was collected.
 *
 * Interface ReaderResultInterface
 * @package Team3\PayU\PropertyExtractor\Reader
 */
interface ReaderResultInterface
{
    /**
     * @return string
     */
    public function getMethodName();

    /**
     * @return string
     */
    public function getPropertyName();
}
