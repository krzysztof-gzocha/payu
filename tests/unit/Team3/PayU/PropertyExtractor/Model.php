<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace tests\unit\Team3\PayU\PropertyExtractor;

use Team3\PayU\Annotation\PayU;

class Model
{
    /**
     * @PayU(propertyName="test")
     */
    public function method()
    {
        return 1;
    }
}
