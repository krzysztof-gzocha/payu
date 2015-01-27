<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\Order\Transformer\UserOrder;

use Psr\Log\LoggerInterface;
use Team3\PayU\Order\Transformer\UserOrder\Strategy\BuyerTransformer;
use Team3\PayU\Order\Transformer\UserOrder\Strategy\DeliveryTransformer;
use Team3\PayU\Order\Transformer\UserOrder\Strategy\GeneralTransformer;
use Team3\PayU\Order\Transformer\UserOrder\Strategy\InvoiceTransformer;
use Team3\PayU\Order\Transformer\UserOrder\Strategy\Product\ProductCollectionTransformer;
use Team3\PayU\Order\Transformer\UserOrder\Strategy\Product\SingleProductTransformer;
use Team3\PayU\Order\Transformer\UserOrder\Strategy\RecursiveTransformerStrategy;
use Team3\PayU\Order\Transformer\UserOrder\Strategy\ShippingMethod\ShippingMethodCollectionTransformer;
use Team3\PayU\Order\Transformer\UserOrder\Strategy\ShippingMethod\SingleShippingMethodTransformer;
use Team3\PayU\Order\Transformer\UserOrder\Strategy\UrlsTransformer;
use Team3\PayU\Order\Transformer\UserOrder\Strategy\UserOrderTransformerStrategiesProvider;
use Team3\PayU\Order\Transformer\UserOrder\Strategy\UserOrderTransformerStrategyInterface;
use Team3\PayU\PropertyExtractor\ExtractorInterface;
use Team3\PayU\PropertyExtractor\PropertyExtractorFactory;

class UserOrderTransformerFactory implements UserOrderTransformerFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return UserOrderTransformer
     */
    public function build(LoggerInterface $logger)
    {
        $extractor = $this->getPropertyExtractor($logger);
        $transformer = new UserOrderTransformer($extractor);
        $strategiesProvider = new UserOrderTransformerStrategiesProvider();
        $strategies = $strategiesProvider->getStrategies($extractor, $transformer);

        foreach ($strategies as $strategy) {
            $transformer->addStrategy($strategy);
        }

        return $transformer;
    }

    /**
     * @param LoggerInterface $logger
     *
     * @return ExtractorInterface
     */
    private function getPropertyExtractor(LoggerInterface $logger)
    {
        $factory = new PropertyExtractorFactory();

        return $factory->build($logger);
    }
}
