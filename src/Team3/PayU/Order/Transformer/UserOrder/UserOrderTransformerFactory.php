<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\Order\Transformer\UserOrder;

use Psr\Log\LoggerInterface;
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
        return new UserOrderTransformer(
            $this->getPropertyExtractor($logger)
        );
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
