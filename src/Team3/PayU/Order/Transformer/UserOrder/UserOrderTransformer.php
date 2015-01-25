<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\Order\Transformer\UserOrder;

use Team3\PayU\Order\Model\Order;
use Team3\PayU\Order\Model\OrderInterface;
use Team3\PayU\PropertyExtractor\ExtractorInterface;
use Team3\PayU\PropertyExtractor\ExtractorResult;
use Team3\PayU\Order\Transformer\UserOrder\Strategy\UserOrderTransformerStrategyInterface;

class UserOrderTransformer implements UserOrderTransformerInterface
{
    /**
     * @var UserOrderTransformerStrategyInterface[]
     */
    protected $strategies;

    /**
     * @var ExtractorInterface
     */
    protected $extractor;

    /**
     * @param ExtractorInterface $extractor
     */
    public function __construct(ExtractorInterface $extractor)
    {
        $this->extractor = $extractor;
        $this->strategies = [];
    }

    /**
     * @inheritdoc
     */
    public function transform(OrderInterface $order, $userOrder)
    {
        foreach ($this->getExtractedResults($userOrder) as $extractionResult) {
            foreach ($this->strategies as $strategy) {
                if ($strategy->supports($extractionResult->getPropertyName())) {
                    $strategy->transform(
                        $order,
                        $extractionResult
                    );
                }
            }
        }

        return $order;
    }

    /**
     * @param UserOrderTransformerStrategyInterface $userOrderTransformerStrategy
     */
    public function addStrategy(
        UserOrderTransformerStrategyInterface $userOrderTransformerStrategy
    ) {
        $this->strategies[] = $userOrderTransformerStrategy;
    }

    /**
     * @param $userOrder
     *
     * @return ExtractorResult[]
     */
    protected function getExtractedResults($userOrder)
    {
        return $this
            ->extractor
            ->extract($userOrder);
    }
}
