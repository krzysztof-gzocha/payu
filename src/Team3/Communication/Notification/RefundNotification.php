<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication\Notification;

use Team3\Communication\Response\Model\RefundModelInterface;
use JMS\Serializer\Annotation as JMS;

class RefundNotification implements NotificationInterface
{
    /**
     * @var string
     * @JMS\Type("string")
     */
    private $orderId;

    /**
     * @var string
     * @JMS\Type("string")
     */
    private $extOrderId;

    /**
     * @var RefundModelInterface
     * @JMS\Type("Team3\Communication\Response\Model\RefundModelInterface")
     */
    private $refund;

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @return string
     */
    public function getExtOrderId()
    {
        return $this->extOrderId;
    }

    /**
     * @return RefundModelInterface
     */
    public function getRefund()
    {
        return $this->refund;
    }
}
