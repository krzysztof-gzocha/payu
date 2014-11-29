<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy;

use Team3\Order\Model\OrderInterface;
use Team3\PropertyExtractor\ExtractorResult;

interface UserOrderTransformerStrategyInterface
{
    /**
     * @param OrderInterface  $order
     * @param ExtractorResult $extractorResult
     *
     * @return OrderInterface
     */
    public function transform(
        OrderInterface $order,
        ExtractorResult $extractorResult
    );

    /**
     * @param string $propertyName
     *
     * @return bool
     */
    public function supports($propertyName);
}
