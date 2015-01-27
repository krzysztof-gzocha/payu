<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\Order\Transformer\UserOrder\Strategy;

use Team3\PayU\Order\Transformer\UserOrder\Strategy\Product\ProductCollectionTransformer;
use Team3\PayU\Order\Transformer\UserOrder\Strategy\Product\SingleProductTransformer;
use Team3\PayU\Order\Transformer\UserOrder\Strategy\ShippingMethod\ShippingMethodCollectionTransformer;
use Team3\PayU\Order\Transformer\UserOrder\Strategy\ShippingMethod\SingleShippingMethodTransformer;
use Team3\PayU\Order\Transformer\UserOrder\UserOrderTransformerInterface;
use Team3\PayU\PropertyExtractor\ExtractorInterface;

/**
 * Class UserOrderTransformerStrategiesProvider
 * @package Team3\PayU\Order\Transformer\UserOrder\Strategy
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class UserOrderTransformerStrategiesProvider implements UserOrderTransformerStrategiesProviderInterface
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
    ) {
        return [
            new ProductCollectionTransformer(
                new SingleProductTransformer($extractor)
            ),
            new ShippingMethodCollectionTransformer(
                new SingleShippingMethodTransformer($extractor)
            ),
            new BuyerTransformer(),
            new DeliveryTransformer(),
            new GeneralTransformer(),
            new InvoiceTransformer(),
            new RecursiveTransformerStrategy($userOrderTransformer),
            new UrlsTransformer(),
        ];
    }
}
