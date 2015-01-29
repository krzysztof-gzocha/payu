<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Notification;

use Team3\PayU\Communication\Response\Model\RefundModelInterface;
use JMS\Serializer\Annotation as JMS;

/**
 * This class represents notification received from PayU
 * about any changes in money refund.
 *
 * Class RefundNotification
 * @package Team3\PayU\Communication\Notification
 */
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
     * @JMS\Type("Team3\PayU\Communication\Response\Model\RefundModelInterface")
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
