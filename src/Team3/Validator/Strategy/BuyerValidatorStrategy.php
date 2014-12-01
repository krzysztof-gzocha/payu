<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Validator\Strategy;

use Team3\Order\Model\Buyer\BuyerInterface;
use Team3\Order\Model\OrderInterface;
use Team3\Validator\AbstractValidator;
use Team3\Validator\ValidationError;

class BuyerValidatorStrategy extends AbstractValidator
{
    /**
     * @param OrderInterface $order
     *
     * @return bool
     */
    public function validate(OrderInterface $order)
    {
        $buyer = $order->getBuyer();
        if (!$buyer->isFilled()) {
            return true;
        }

        $this
            ->checkEmail($buyer)
            ->checkNames($buyer);
    }

    /**
     * @param BuyerInterface $buyer
     *
     * @return $this
     */
    private function checkEmail(BuyerInterface $buyer)
    {
        if (null == $buyer->getEmail()) {
            $this->addValidationError(
                $buyer,
                'Buyer has no email specified',
                'email'
            );
        }

        return $this;
    }

    /**
     * @param BuyerInterface $buyer
     *
     * @return $this
     */
    private function checkNames(BuyerInterface $buyer)
    {
        if (null == $buyer->getFirstName()) {
            $this->addValidationError(
                $buyer,
                'Buyer has no first name specified',
                'firstName'
            );
        }

        if (null == $buyer->getLastName()) {
            $this->addValidationError(
                $buyer,
                'Buyer has no last namespecified',
                'lastName'
            );
        }

        return $this;
    }
}
