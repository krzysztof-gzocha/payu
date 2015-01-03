<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication\Request;

use Team3\Order\Model\OrderInterface;

class OrderCreateRequest extends AbstractPayURequest
{
    /**
     * @param OrderInterface $order
     */
    public function __construct(OrderInterface $order)
    {
        $this->data = $order;
        $this->path = 'orders';
    }
}
