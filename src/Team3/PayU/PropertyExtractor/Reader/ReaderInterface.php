<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\PropertyExtractor\Reader;

interface ReaderInterface
{
    /**
     * @param object $object
     *
     * @return ReaderResultInterface[]
     */
    public function read($object);
}
