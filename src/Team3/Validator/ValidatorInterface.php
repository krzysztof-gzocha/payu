<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Validator;

use Team3\Order\Model\OrderInterface;

interface ValidatorInterface
{
    /**
     * @param OrderInterface $order
     *
     * @return bool
     */
    public function validate(OrderInterface $order);

    /**
     * @return ValidationErrorInterface[]
     */
    public function getValidationErrors();
}
