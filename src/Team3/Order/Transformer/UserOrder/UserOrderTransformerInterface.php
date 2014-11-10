<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order\Transformer\UserOrder;

use Team3\Order\Model\OrderInterface;

interface UserOrderTransformerInterface
{
    /**
     * @param OrderInterface $order
     * @param object         $userOrder
     *
     * @return OrderInterface
     */
    public function transform(OrderInterface $order, $userOrder);
}
