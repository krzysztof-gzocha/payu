<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Validator\Strategy;

use Team3\Order\Model\Buyer\BuyerInterface;
use Team3\Order\Model\OrderInterface;
use Team3\Validator\AbstractValidator;

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

        if ($this->shouldNotValidate($buyer)) {
            return true;
        }

        $this
            ->checkEmail($buyer)
            ->checkNames($buyer);

        return $this->hasNoErrors();
    }

    /**
     * @param BuyerInterface $buyer
     *
     * @return bool
     */
    protected function shouldNotValidate(BuyerInterface $buyer)
    {
        return !$buyer->getEmail()
            && !$buyer->getFirstName()
            && !$buyer->getLastName();
    }

    /**
     * @param BuyerInterface $buyer
     *
     * @return $this
     */
    protected function checkEmail(BuyerInterface $buyer)
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
    protected function checkNames(BuyerInterface $buyer)
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
                'Buyer has no last name specified',
                'lastName'
            );
        }

        return $this;
    }
}
