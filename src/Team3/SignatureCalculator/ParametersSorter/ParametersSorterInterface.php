<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\SignatureCalculator\ParametersSorter;

use Team3\Order\Model\OrderInterface;

interface ParametersSorterInterface
{
    /**
     * @param OrderInterface $order
     *
     * @return array
     */
    public function getSortedParameters(OrderInterface $order);
}
