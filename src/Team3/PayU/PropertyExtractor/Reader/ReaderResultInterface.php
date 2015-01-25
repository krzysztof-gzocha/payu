<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\PropertyExtractor\Reader;

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
