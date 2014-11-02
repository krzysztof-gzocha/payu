<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy;

use Team3\Order\Annotation\PayU;
use Team3\Order\Model\OrderInterface;
use \ReflectionMethod;

interface UserOrderTransformerStrategyInterface
{
    /**
     * @param OrderInterface   $order
     * @param object           $userOrder
     * @param ReflectionMethod $reflectionMethod
     *
     * @return OrderInterface
     */
    public function transform(
        OrderInterface $order,
        $userOrder,
        ReflectionMethod $reflectionMethod
    );

    /**
     * @param PayU $annotation
     *
     * @return bool
     */
    public function supports(PayU $annotation);
}
