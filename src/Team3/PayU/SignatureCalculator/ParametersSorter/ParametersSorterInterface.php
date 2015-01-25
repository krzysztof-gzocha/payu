<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\SignatureCalculator\ParametersSorter;

use Team3\PayU\Order\Model\OrderInterface;

interface ParametersSorterInterface
{
    /**
     * @param OrderInterface $order
     *
     * @return array
     */
    public function getSortedParameters(OrderInterface $order);
}
