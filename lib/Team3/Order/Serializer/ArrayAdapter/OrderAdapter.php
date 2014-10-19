<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer\ArrayAdapter;

use Team3\Order\Model\OrderInterface;
use Team3\Order\Serializer\ArrayAdapter\Step\SerializableAdapterStepInterface;

class OrderAdapter implements SerializableAdapterInterface
{
    /**
     * @var SerializableAdapterStepInterface[]
     */
    protected $adapterSteps;

    /**
     * @var array
     */
    protected $result;

    public function __construct()
    {
        $this->adapterSteps = [];
        $this->result = [];
    }

    /**
     * @inheritdoc
     */
    public function toArray(OrderInterface $order)
    {
        /** @var SerializableAdapterStepInterface $adapterStep */
        foreach ($this->adapterSteps as $adapterStep) {
            if ($adapterStep->shouldAdapt($order)) {
                $this->addAdapterResult(
                    $adapterStep->toArray($order)
                );
            }
        }

        return $this->result;
    }

    /**
     * @param  SerializableAdapterStepInterface $adapterStep
     * @return SerializableAdapterInterface
     */
    public function addAdapterStep(SerializableAdapterStepInterface $adapterStep)
    {
        $this->adapterSteps[] = $adapterStep;

        return $this;
    }

    /**
     * @param array $adapterResult
     */
    private function addAdapterResult(array $adapterResult)
    {
        array_merge(
            $this->result,
            $adapterResult
        );
    }
}
