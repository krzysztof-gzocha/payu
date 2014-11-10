<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy;

use Team3\Order\Model\OrderInterface;
use Team3\Order\PropertyExtractor\ExtractorResult;
use Team3\Order\Transformer\UserOrder\UserOrderTransformerInterface;

abstract class AbstractRecursiveTransformerStrategy implements RecursiveUserOrderTransformerStrategyInterface
{
    /**
     * @var UserOrderTransformerInterface
     */
    private $transformer;

    /**
     * @inheritdoc
     */
    public function setMainTransformer(
        UserOrderTransformerInterface $transformer
    ) {
        $this->transformer = $transformer;
    }

    /**
     * @inheritdoc
     */
    public function transform(
        OrderInterface $order,
        $userOrder,
        ExtractorResult $extractorResult
    ) {
        $this->transformer->transform($order, $extractorResult->getValue());
    }
}
