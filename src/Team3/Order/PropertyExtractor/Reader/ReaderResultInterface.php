<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\PropertyExtractor\Reader;

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
