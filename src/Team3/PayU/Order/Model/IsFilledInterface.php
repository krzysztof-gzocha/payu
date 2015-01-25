<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\Order\Model;

interface IsFilledInterface
{
    /**
     * Return true if given object is filled
     *
     * @return bool
     */
    public function isFilled();
}
