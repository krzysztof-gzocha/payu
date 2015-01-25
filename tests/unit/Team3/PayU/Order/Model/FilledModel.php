<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace tests\unit\Team3\PayU\Order\Model;

use Team3\PayU\Order\Model\IsFilledInterface;

class FilledModel implements IsFilledInterface
{
    /**
     * @inheritdoc
     */
    public function isFilled()
    {
        return true;
    }
}
