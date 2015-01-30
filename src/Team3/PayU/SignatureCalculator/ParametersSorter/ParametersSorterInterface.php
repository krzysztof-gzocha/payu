<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\SignatureCalculator\ParametersSorter;

use Team3\PayU\Order\Model\OrderInterface;

/**
 * Is responsible to transform {@link OrderInterface}
 * into array of parameters in alphabetical order.
 *
 * Interface ParametersSorterInterface
 * @package Team3\PayU\SignatureCalculator\ParametersSorter
 */
interface ParametersSorterInterface
{
    /**
     * @param OrderInterface $order
     *
     * @return array
     */
    public function getSortedParameters(OrderInterface $order);
}
