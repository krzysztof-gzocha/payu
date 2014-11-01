<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder;

use Team3\Order\Annotation\Extractor\AnnotationsExtractorInterface;
use Team3\Order\Annotation\Extractor\AnnotationsExtractorResult;
use Team3\Order\Model\Order;
use Team3\Order\Transformer\UserOrder\Strategy\UserOrderTransformerStrategyInterface;

class UserOrderTransformer
{
    /**
     * @var UserOrderTransformerStrategyInterface[]
     */
    protected $strategies;

    /**
     * @var AnnotationsExtractorInterface
     */
    protected $annotationsExtractor;

    /**
     * @param AnnotationsExtractorInterface $annotationsExtractor
     */
    public function __construct(
        AnnotationsExtractorInterface $annotationsExtractor
    ) {
        $this->annotationsExtractor = $annotationsExtractor;
        $this->strategies = [];
    }

    /**
     * @param object $userOrder
     *
     * @return Order
     */
    public function transform($userOrder)
    {
        $order = new Order();

        foreach ($this->getExtractedAnnotations($userOrder) as $extractionResult) {
            foreach ($this->strategies as $strategy) {
                if ($strategy->supports($extractionResult->getAnnotation())) {
                    $strategy->transform(
                        $order,
                        $extractionResult->getReflectionMethod()
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
     * @return AnnotationsExtractorResult[]
     */
    protected function getExtractedAnnotations($userOrder)
    {
        return $this
            ->annotationsExtractor
            ->extractAnnotations($userOrder);
    }
}
