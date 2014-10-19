<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order\Compilator;

/**
 * OrderCompilator should be used to compile order in existing system
 * into order's model which can be processed by this library.
 * OrderCompilator will use separate steps to compile separate parameters,
 * so to compile buyer parameters there should be used BuyerCompilationStep.
 * You can use OrderCompilator as OrderCompilationStep so your steps can be hierarchical.
 *
 * Interface OrderCompilatorInterface
 * @package Team3\Order\Compilator
 */
interface OrderCompilatorInterface extends OrderCompilationStepInterface
{
    /**
     * @param OrderCompilationStepInterface $orderCompilationStep
     */
    public function addCompilationStep(OrderCompilationStepInterface $orderCompilationStep);
}
