<?php

namespace spec\Team3\Validator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Team3\Order\Model\OrderInterface;
use Team3\Validator\ValidationErrorInterface;
use Team3\Validator\ValidatorInterface;

/**
 * Class ValidatorSpec
 * @package spec\Team3\Validator
 */
class ValidatorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Team3\Validator\Validator');
        $this->shouldImplement('Team3\Validator\ValidatorInterface');
    }

    public function it_should_call_every_strategy(
        OrderInterface $order,
        ValidatorInterface $firstStep,
        ValidatorInterface $secondStep
    ) {
        $firstStep->validate($order)->shouldBeCalledTimes(1);
        $secondStep->validate($order)->shouldBeCalledTimes(1);

        $firstStep->validate($order)->willReturn(true);
        $secondStep->validate($order)->willReturn(true);

        $this->addValidatorStrategy($firstStep);
        $this->addValidatorStrategy($secondStep);

        $this->validate($order);
    }

    public function it_should_collect_errors_from_every_strategy(
        OrderInterface $order,
        ValidatorInterface $firstStep,
        ValidatorInterface $secondStep,
        ValidationErrorInterface $firstError,
        ValidationErrorInterface $secondError
    ) {
        $firstStep->validate($order)->willReturn(false);
        $firstStep->getValidationErrors()->willReturn([$firstError]);

        $secondStep->validate($order)->willReturn(false);
        $secondStep->getValidationErrors()->willReturn([$secondError]);

        $this->addValidatorStrategy($firstStep);
        $this->addValidatorStrategy($secondStep);

        $this->validate($order)->shouldReturn(false);
        $this->getValidationErrors()->shouldHaveCount(2);

        foreach ($this->getValidationErrors() as $validationError) {
            $validationError->shouldImplement('Team3\Validator\ValidationErrorInterface');
        }
    }
}
