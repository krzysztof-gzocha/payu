<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Notification;

use Team3\PayU\Order\Model\OrderInterface;
use JMS\Serializer\Annotation as JMS;

class OrderNotification implements NotificationInterface
{
    /**
     * @var OrderInterface
     * @JMS\Type("Team3\PayU\Order\Model\Order")
     * @JMS\SerializedName("order")
     */
    private $order;

    /**
     * @return OrderInterface
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param OrderInterface $order
     *
     * @return OrderNotification
     */
    public function setOrder(OrderInterface $order)
    {
        $this->order = $order;

        return $this;
    }
}
