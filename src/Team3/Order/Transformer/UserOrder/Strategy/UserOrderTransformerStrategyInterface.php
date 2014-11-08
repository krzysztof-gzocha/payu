<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy;

use Team3\Order\Annotation\Extractor\AnnotationsExtractorResult;
use Team3\Order\Annotation\PayU;
use Team3\Order\Model\OrderInterface;

interface UserOrderTransformerStrategyInterface
{
    /**
     * @param OrderInterface             $order
     * @param object                     $userOrder
     * @param AnnotationsExtractorResult $annotationsExtractorResult
     *
     * @return OrderInterface
     */
    public function transform(
        OrderInterface $order,
        $userOrder,
        AnnotationsExtractorResult $annotationsExtractorResult
    );

    /**
     * @param PayU $annotation
     *
     * @return bool
     */
    public function supports(PayU $annotation);
}
