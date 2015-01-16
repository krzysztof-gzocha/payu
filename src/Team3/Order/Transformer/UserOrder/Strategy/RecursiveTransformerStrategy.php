<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy;

use Team3\Order\Model\OrderInterface;
use Team3\Order\Transformer\UserOrder\TransformerProperties;
use Team3\PropertyExtractor\ExtractorResult;
use Team3\Order\Transformer\UserOrder\UserOrderTransformerInterface;

class RecursiveTransformerStrategy implements UserOrderTransformerStrategyInterface
{
    /**
     * @var UserOrderTransformerInterface
     */
    private $transformer;

    /**
     * @inheritdoc
     */
    public function __construct(
        UserOrderTransformerInterface $transformer
    ) {
        $this->transformer = $transformer;
    }

    /**
     * @inheritdoc
     */
    public function transform(
        OrderInterface $order,
        ExtractorResult $extractorResult
    ) {
        $this->transformer->transform($order, $extractorResult->getValue());
    }

    /**
     * @inheritdoc
     */
    public function supports($propertyName)
    {
        return TransformerProperties::RECURSIVE === $propertyName;
    }
}
