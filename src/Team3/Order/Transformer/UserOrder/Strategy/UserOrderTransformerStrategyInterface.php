<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy;

use Team3\Order\Annotation\OrderAnnotationInterface;
use Team3\Order\Annotation\OrderPropertyAnnotationInterface;
use Team3\Order\Model\OrderInterface;

interface UserOrderTransformerStrategyInterface
{
    /**
     * Insert proper values which can be read from $reflectionClass and $orderPropertiesAnnotations
     * into $order.
     *
     * @param OrderInterface                     $order
     * @param \ReflectionClass                   $reflectionClass
     * @param OrderPropertyAnnotationInterface[] $orderPropertiesAnnotations
     *
     * @return OrderInterface
     */
    public function transform(
        OrderInterface $order,
        \ReflectionClass $reflectionClass,
        array $orderPropertiesAnnotations
    );

    /**
     * @param OrderAnnotationInterface $orderAnnotation
     *
     * @return bool
     */
    public function supports(OrderAnnotationInterface $orderAnnotation);
}
