<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer\ArrayAdapter\Step;

use Team3\Order\Model\OrderInterface;

abstract class AbstractAdapterStep implements SerializableAdapterStepInterface
{
    /**
     * @var SerializableAdapterStepInterface[]
     */
    private $adapterSteps;

    public function __construct()
    {
        $this->adapterSteps = [];
    }

    /**
     * @param SerializableAdapterStepInterface $adapterStep
     *
     * @return $this
     */
    public function addAdapterStep(SerializableAdapterStepInterface $adapterStep)
    {
       $this->adapterSteps[] = $adapterStep;

        return $this;
    }

    /**
     * @param array          $result
     * @param OrderInterface $order
     *
     * @return array
     */
    protected function addResultsFromSteps(array $result, OrderInterface $order)
    {
        foreach ($this->adapterSteps as $adapterStep) {
            if ($adapterStep->shouldAdapt($order)) {
                array_merge(
                    $result,
                    $adapterStep->toArray($order)
                );
            }
        }

        return $result;
    }
}
