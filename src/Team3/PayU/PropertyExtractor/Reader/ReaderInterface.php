<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\PropertyExtractor\Reader;

/**
 * This class is responsible to read single object for required parameters.
 * It will return array {@link ReaderResultInterface}.
 *
 * Interface ReaderInterface
 * @package Team3\PayU\PropertyExtractor\Reader
 */
interface ReaderInterface
{
    /**
     * @param object $object
     *
     * @return ReaderResultInterface[]
     */
    public function read($object);
}
