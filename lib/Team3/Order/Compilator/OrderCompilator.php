<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Compilator;

use Team3\Order\Model\OrderInterface;

class OrderCompilator implements OrderCompilatorInterface
{
    /**
     * @var OrderCompilationStepInterface[]
     */
    protected $compilationSteps;

    public function __construct()
    {
        $this->compilationSteps = [];
    }

    /**
     * @inheritdoc
     */
    public function addCompilationStep(
        OrderCompilationStepInterface $orderCompilationStep
    ) {
        $this->compilationSteps[] = $orderCompilationStep;
    }

    /**
     * @inheritdoc
     */
    public function compile(OrderInterface $order, $usersOrder)
    {
        if (0 == count($this->compilationSteps)) {
            throw new OrderCompilationException(
                'There is no compilation steps specified.'
            );
        }

        /** @var OrderCompilationStepInterface $compilationStep */
        foreach ($this->compilationSteps as $compilationStep) {
            $compilationStep->compile($order, $usersOrder);
        }

        return $order;
    }
}
