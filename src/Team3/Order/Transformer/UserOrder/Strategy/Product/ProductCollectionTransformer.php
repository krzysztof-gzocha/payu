<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy\Product;

use Team3\Order\Model\OrderInterface;
use Team3\Order\PropertyExtractor\ExtractorResult;
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
        ExtractorResult $extractorResult
    ) {
        $usersProductCollection = $extractorResult->getValue();
        $this->checkProductCollection($usersProductCollection);

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
    public function supports($propertyName)
    {
        return self::PARAMETER_NAME === $propertyName;
    }

    /**
     * Checks if product collection is array or object which implements Traversable.
     * If not throws UserOrderTransformerException.
     *
     * @param mixed $productCollection
     *
     * @return bool
     * @throws UserOrderTransformerException
     */
    private function checkProductCollection(
        $productCollection
    ) {
        if (!is_array($productCollection)
            && !$productCollection instanceof \Traversable) {
            throw new UserOrderTransformerException(sprintf(
                'Value should be an array or object which implements \Traversable, but it returns %s',
                gettype($productCollection)
            ));
        }
    }
}
