<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace tests\unit\Team3\Order\PropertyExtractor;

use Team3\Order\Annotation\PayU;

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
