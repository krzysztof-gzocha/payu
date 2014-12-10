<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Validator\Strategy;

use Team3\Order\Model\OrderInterface;
use Team3\Validator\AbstractValidator;

class ProductCollectionStrategy extends AbstractValidator
{
    /**
     * @inheritdoc
     */
    public function validate(OrderInterface $order)
    {
        return $this->checkProductsCount($order);
    }

    /**
     * @param OrderInterface $order
     *
     * @return bool
     */
    private function checkProductsCount(
        OrderInterface $order
    ) {
        if (0 == $order->getProductCollection()->count()) {
            $this->addValidationError(
                $order,
                'Product collection can not be empty',
                'productCollection'
            );

            return false;
        }

        return true;
    }
}
