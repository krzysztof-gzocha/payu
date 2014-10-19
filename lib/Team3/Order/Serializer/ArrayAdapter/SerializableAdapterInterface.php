<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order\Serializer\ArrayAdapter;

use Team3\Order\Model\OrderInterface;
use Team3\Order\Serializer\ArrayAdapter\Step\SerializableAdapterStepInterface;

interface SerializableAdapterInterface
{
    /**
     * @param  OrderInterface $order
     * @return array
     */
    public function toArray(OrderInterface $order);

    /**
     * @param  SerializableAdapterStepInterface $adapterStep
     * @return $this
     */
    public function addAdapterStep(SerializableAdapterStepInterface $adapterStep);
}
