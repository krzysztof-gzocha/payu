<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Order\Transformer\UserOrder\Strategy;

use Team3\PayU\Order\Transformer\UserOrder\UserOrderTransformerInterface;
use Team3\PayU\PropertyExtractor\ExtractorInterface;

interface UserOrderTransformerStrategiesProviderInterface
{
    /**
     * @param ExtractorInterface            $extractor
     * @param UserOrderTransformerInterface $userOrderTransformer
     *
     * @return UserOrderTransformerStrategyInterface[]
     */
    public function getStrategies(
        ExtractorInterface $extractor,
        UserOrderTransformerInterface $userOrderTransformer
    );
}
