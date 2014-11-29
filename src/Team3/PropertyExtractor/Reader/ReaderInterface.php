<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PropertyExtractor\Reader;

interface ReaderInterface
{
    /**
     * @param object $object
     *
     * @return ReaderResultInterface[]
     */
    public function read($object);
}
