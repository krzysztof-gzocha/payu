<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder;

use Team3\Order\PropertyExtractor\ExtractorInterface;
use Team3\Order\Transformer\UserOrder\Strategy\BuyerTransformer;
use Team3\Order\Transformer\UserOrder\Strategy\DeliveryTransformer;
use Team3\Order\Transformer\UserOrder\Strategy\General\GeneralTransformer;
use Team3\Order\Transformer\UserOrder\Strategy\InvoiceTransformer;
use Team3\Order\Transformer\UserOrder\Strategy\Product\ProductCollectionTransformer;
use Team3\Order\Transformer\UserOrder\Strategy\Product\SingleProductTransformer;
use Team3\Order\Transformer\UserOrder\Strategy\RecursiveTransformerStrategy;
use Team3\Order\Transformer\UserOrder\Strategy\ShippingMethod\ShippingMethodCollectionTransformer;
use Team3\Order\Transformer\UserOrder\Strategy\ShippingMethod\SingleShippingMethodTransformer;
use Team3\Order\Transformer\UserOrder\Strategy\UrlsTransformer;
use Team3\Order\Transformer\UserOrder\Strategy\UserOrderTransformerStrategyInterface;

class UserOrderTransformerBuilder
{
    /**
     * @param ExtractorInterface $extractor
     *
     * @return UserOrderTransformer
     */
    public function build(ExtractorInterface $extractor)
    {
        $transformer = new UserOrderTransformer($extractor);

        foreach ($this->getStrategies($extractor, $transformer) as $strategy) {
            $transformer->addStrategy($strategy);
        }

        return $transformer;
    }

    /**
     * @param ExtractorInterface            $extractor
     * @param UserOrderTransformerInterface $userOrderTransformer
     *
     * @return UserOrderTransformerStrategyInterface[]
     */
    protected function getStrategies(
        ExtractorInterface $extractor,
        UserOrderTransformerInterface $userOrderTransformer
    ) {
        return [
            new RecursiveTransformerStrategy($userOrderTransformer),
            new ProductCollectionTransformer(
                new SingleProductTransformer($extractor)
            ),
            new ShippingMethodCollectionTransformer(
                new SingleShippingMethodTransformer($extractor)
            ),
            new BuyerTransformer(),
            new DeliveryTransformer(),
            new InvoiceTransformer(),
            new UrlsTransformer(),
            new GeneralTransformer(),
        ];
    }
}
