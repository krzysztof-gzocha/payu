<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Validator;

use Team3\Order\Model\OrderInterface;

class Validator extends AbstractValidator
{
    /**
     * @var ValidatorInterface[]
     */
    private $validatorStrategies;

    public function __construct()
    {
        parent::__construct();
        $this->validatorStrategies = [];
    }

    /**
     * @inheritdoc
     */
    public function validate(OrderInterface $order)
    {
        $result = true;

        foreach ($this->validatorStrategies as $validationStrategy) {
            if (!$validationStrategy->validate($order)) {
                $result = false;
                array_merge(
                    $this->getValidationErrors(),
                    $validationStrategy->getValidationErrors()
                );
            }
        }

        return $result;
    }

    /**
     * @param ValidatorInterface $validatorStrategy
     */
    public function addValidatorStrategy(ValidatorInterface $validatorStrategy)
    {
        $this->validatorStrategies[] = $validatorStrategy;
    }
}
