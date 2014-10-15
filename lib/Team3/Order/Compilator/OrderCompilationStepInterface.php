<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Compilator;

use Team3\Order\Model\OrderInterface;

interface OrderCompilationStepInterface
{
    /**
     * @param OrderInterface $order
     * @param mixed          $usersOrder
     *
     * @throws OrderCompilationException
     */
    public function compile(OrderInterface $order, $usersOrder);
}
