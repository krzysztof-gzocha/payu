<?php

namespace spec\Team3\Order\Compilator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Team3\Order\Compilator\OrderCompilationException;
use Team3\Order\Compilator\OrderCompilationStepInterface;
use Team3\Order\Model\OrderInterface;

class OrderCompilatorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Team3\Order\Compilator\OrderCompilator');
    }

    public function it_should_throw_exception_when_no_steps_specified(
        OrderInterface $order,
        $usersOrder
    ) {
        $this
            ->shouldThrow($this->getNoCompilationStepsException())
            ->during('compile', [$order, $usersOrder]);
    }

    public function it_should_not_throw_exception_when_steps_are_specified(
        OrderCompilationStepInterface $orderCompilationStep,
        OrderInterface $order,
        $usersOrder
    ) {
        $this->addCompilationStep($orderCompilationStep);

        $this
            ->shouldNotThrow($this->getNoCompilationStepsException())
            ->during('compile', [$order, $usersOrder]);
    }

    public function it_should_call_compilation_step(
        OrderCompilationStepInterface $orderCompilationStep,
        OrderInterface $order,
        $usersOrder
    ) {
        $orderCompilationStep->compile($order, $usersOrder)->shouldBeCalledTimes(1);
        $this->addCompilationStep($orderCompilationStep);

        $this->compile($order, $usersOrder)->shouldBeLike($order);
    }

    /**
     * @return OrderCompilationException
     */
    protected function getNoCompilationStepsException()
    {
        return new OrderCompilationException('There is no compilation steps specified.');
    }
}
