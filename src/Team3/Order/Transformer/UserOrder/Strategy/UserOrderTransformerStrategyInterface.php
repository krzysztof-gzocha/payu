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
     * Insert proper values which can be read from $reflectionClass and $orderPropertiesAnnotations
     * into $order.
     *
     * @param OrderInterface   $order
     * @param ReflectionMethod $reflectionMethod
     *
     * @return OrderInterface
     */
    public function transform(
        OrderInterface $order,
        ReflectionMethod $reflectionMethod
    );

    /**
     * @param PayU $annotation
     *
     * @return bool
     */
    public function supports(PayU $annotation);
}
