<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Request;

use Team3\PayU\Order\Model\OrderInterface;

/**
 * This class can be used with {@link RequestProcessInterface}.
 * It will create new order.
 *
 * Class OrderCreateRequest
 * @package Team3\PayU\Communication\Request
 */
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
