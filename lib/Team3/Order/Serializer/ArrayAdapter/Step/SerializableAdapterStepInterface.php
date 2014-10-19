<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer\ArrayAdapter\Step;

use Team3\Order\Model\OrderInterface;
use Team3\Order\Serializer\ArrayAdapter\SerializableAdapterInterface;

interface SerializableAdapterStepInterface extends SerializableAdapterInterface
{
    /**
     * @param OrderInterface $order
     *
     * @return bool
     */
    public function shouldAdapt(OrderInterface $order);
}
