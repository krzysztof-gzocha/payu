<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy;

use Team3\Order\Transformer\UserOrder\UserOrderTransformerInterface;

interface RecursiveUserOrderTransformerStrategyInterface extends UserOrderTransformerStrategyInterface
{
    /**
     * @param UserOrderTransformerInterface $transformer
     */
    public function setMainTransformer(
        UserOrderTransformerInterface $transformer
    );
}
