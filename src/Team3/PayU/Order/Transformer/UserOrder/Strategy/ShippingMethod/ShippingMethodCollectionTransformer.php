<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\Order\Transformer\UserOrder\Strategy\ShippingMethod;

use Team3\PayU\Order\Model\OrderInterface;
use Team3\PayU\Order\Transformer\UserOrder\TransformerProperties;
use Team3\PayU\PropertyExtractor\ExtractorException;
use Team3\PayU\PropertyExtractor\ExtractorResult;
use Team3\PayU\Order\Transformer\UserOrder\Strategy\UserOrderTransformerStrategyInterface;

class ShippingMethodCollectionTransformer implements UserOrderTransformerStrategyInterface
{
    /**
     * @var SingleShippingMethodTransformer
     */
    private $singleShippingMethodTransformer;

    /**
     * @param SingleShippingMethodTransformer $singleShippingMethodTransformer
     */
    public function __construct(
        SingleShippingMethodTransformer $singleShippingMethodTransformer
    ) {
        $this->singleShippingMethodTransformer = $singleShippingMethodTransformer;
    }

    /**
     * @inheritdoc
     */
    public function transform(
        OrderInterface $order,
        ExtractorResult $extractorResult
    ) {
        /** @var \Traversable $shippingMethodCollection */
        $shippingMethodCollection = $extractorResult->getValue();
        $this->checkCollection($shippingMethodCollection);

        foreach ($shippingMethodCollection as $usersShippingMethod) {
            $order
                ->getShippingMethodCollection()
                ->addShippingMethod(
                    $this
                        ->singleShippingMethodTransformer
                        ->transform(
                            $usersShippingMethod
                        )
                );
        }
    }

    /**
     * @inheritdoc
     */
    public function supports($propertyName)
    {
        return TransformerProperties::SHIPPING_METHOD_COLLECTION === $propertyName;
    }

    /**
     * @param mixed $collection
     *
     * @throws ExtractorException
     */
    protected function checkCollection($collection)
    {
        if (!is_array($collection)
            && !$collection instanceof \Traversable) {
            throw new ExtractorException(sprintf(
                'Array or object which implements Traversable was expected, but %s was given',
                gettype($collection)
            ));
        }
    }
}
