<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication\Notification;

use Team3\Order\Model\OrderInterface;
use JMS\Serializer\Annotation as JMS;
use Team3\Serializer\SerializableInterface;

class OrderNotification implements SerializableInterface
{
    /**
     * @var OrderInterface
     * @JMS\Type("Team3\Order\Model\Order")
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
