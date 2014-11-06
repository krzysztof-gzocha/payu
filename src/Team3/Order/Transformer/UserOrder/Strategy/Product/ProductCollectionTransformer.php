<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy\Product;

use ReflectionMethod;
use Team3\Order\Annotation\PayU;
use Team3\Order\Model\OrderInterface;
use Team3\Order\Transformer\UserOrder\Strategy\UserOrderTransformerStrategyInterface;
use Team3\Order\Transformer\UserOrder\UserOrderTransformerException;

class ProductCollectionTransformer implements UserOrderTransformerStrategyInterface
{
    const PARAMETER_NAME = 'productCollection';

    /**
     * @var SingleProductTransformer
     */
    protected $singleProductTransformer;

    /**
     * @param SingleProductTransformer $singleProductTransformer
     */
    public function __construct(
        SingleProductTransformer $singleProductTransformer
    ) {
        $this->singleProductTransformer = $singleProductTransformer;
    }

    /**
     * @inheritdoc
     */
    public function transform(
        OrderInterface $order,
        $userOrder,
        ReflectionMethod $reflectionMethod
    ) {
        $reflectionMethod->setAccessible(true);
        $usersProductCollection = $reflectionMethod->invoke($userOrder);
        $this->checkProductCollection($usersProductCollection, $reflectionMethod);

        foreach ($usersProductCollection as $userProduct) {
            $order
                ->getProductCollection()
                ->addProduct(
                    $this
                        ->singleProductTransformer
                        ->transform($userProduct)
                );
        }

        return $order;
    }

    /**
     * @inheritdoc
     */
    public function supports(PayU $annotation)
    {
        return self::PARAMETER_NAME === $annotation->getPropertyName();
    }

    /**
     * Checks if product collection is array or object which implements Traversable.
     * If not throws UserOrderTransformerException.
     *
     * @param mixed            $productCollection
     * @param ReflectionMethod $reflectionMethod
     *
     * @return bool
     * @throws UserOrderTransformerException
     */
    private function checkProductCollection(
        $productCollection,
        ReflectionMethod $reflectionMethod
    ) {
        if (!is_array($productCollection)
            && !$productCollection instanceof \Traversable) {
            throw new UserOrderTransformerException(sprintf(
                'Method %s::%s() should return array or object which implements \Traversable, but it returns %s',
                $reflectionMethod->getDeclaringClass()->getName(),
                $reflectionMethod->getName(),
                gettype($productCollection)
            ));
        }
    }
}
