<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Request;

use Team3\PayU\Order\Model\OrderInterface;

/**
 * Used with {@link RequestProcessInterface} will help user to
 * know in what state is his order.
 *
 * Class OrderRetrieveRequest
 * @package Team3\PayU\Communication\Request
 */
class OrderRetrieveRequest extends AbstractPayURequest
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
        return self::METHOD_GET;
    }
}
