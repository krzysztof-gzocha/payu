<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\Reader;
use Team3\Order\Annotation\OrderAnnotationInterface;
use Team3\Order\Model\Order;
use Team3\Order\Model\OrderInterface;
use Team3\Order\Transformer\UserOrder\Strategy\UserOrderTransformerStrategyInterface;

class UserOrderTransformer
{
    /**
     * @var UserOrderTransformerStrategyInterface[]
     */
    protected $strategies;

    /**
     * @var Reader
     */
    protected $annotationReader;

    public function __construct()
    {
        $this->annotationReader = new AnnotationReader();
        $this->strategies = [];
    }

    /**
     * @param array $objects
     *
     * @return OrderInterface
     */
    public function transform(array $objects)
    {
        $order = new Order();

        foreach ($objects as $object) {
            $this->transformSingle($order, $object);
        }

        return $order;
    }

    /**
     * @param UserOrderTransformerStrategyInterface $userOrderTransformerStrategy
     */
    public function addStrategy(
        UserOrderTransformerStrategyInterface $userOrderTransformerStrategy
    ) {
        $this->strategies[] = $userOrderTransformerStrategy;
    }

    /**
     * @param OrderInterface $order
     * @param mixed          $object
     *
     * @return OrderInterface
     */
    protected function transformSingle(OrderInterface $order, $object)
    {
        if (is_array($object)) {
            return $this->transform($order, $object);
        }

        return $this->transformObject($order, $object);
    }

    /**
     * @param OrderInterface $order
     * @param mixed          $object
     *
     * @return OrderInterface
     */
    protected function transformObject(OrderInterface $order, $object)
    {
        $reflectionClass = new \ReflectionClass($object);
        $annotation = $this->getAnnotation($reflectionClass);

        /** @var UserOrderTransformerStrategyInterface $strategy */
        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($annotation)) {
                $strategy->transform(
                    $order,
                    $reflectionClass,
                    $annotation->getProperties()
                );
            }
        }

        return $order;
    }

    /**
     * @param \ReflectionClass $reflectionClass
     *
     * @return OrderAnnotationInterface
     */
    private function getAnnotation(\ReflectionClass $reflectionClass)
    {
        return $this
            ->annotationReader
            ->getClassAnnotation(
                $reflectionClass,
                OrderAnnotationInterface::class
            );
    }
}
