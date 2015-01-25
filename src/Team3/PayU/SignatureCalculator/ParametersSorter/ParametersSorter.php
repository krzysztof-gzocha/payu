<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\SignatureCalculator\ParametersSorter;

use Team3\PayU\Order\Model\OrderInterface;
use Team3\PayU\Serializer\SerializerInterface;

class ParametersSorter implements ParametersSorterInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * Will return order serializable parameters in ascending order.
     *
     * @param  OrderInterface $order
     * @return array
     */
    public function getSortedParameters(OrderInterface $order)
    {
        $json = $this->serializer->toJson($order);

        return $this->serializer->fromJson($json, 'array');
    }
}
