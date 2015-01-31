<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\Communication\Request;

use Team3\PayU\Order\Model\OrderInterface;

/**
 * Is representing model of request to cancel given order.
 *
 * Class OrderCancelRequest
 * @package Team3\PayU\Communication\Request
 */
class OrderCancelRequest extends AbstractPayURequest
{
    /**
     * @param OrderInterface $order
     */
    public function __construct(OrderInterface $order)
    {
        $this->data = $order;
        $this->path = sprintf('orders/%s', $order->getPayUOrderId());
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return self::METHOD_DELETE;
    }
}
