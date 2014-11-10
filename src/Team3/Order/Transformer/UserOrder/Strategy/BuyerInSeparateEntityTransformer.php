<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy;

class BuyerInSeparateEntityTransformer extends AbstractRecursiveTransformerStrategy
{
    /**
     * @inheritdoc
     */
    public function supports($propertyName)
    {
        return 'buyer' === $propertyName;
    }
}
