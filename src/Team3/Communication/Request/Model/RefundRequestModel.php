<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication\Request\Model;

use Team3\Order\Model\Money\MoneyInterface;
use Team3\Order\Model\OrderInterface;
use JMS\Serializer\Annotation as JMS;
use Team3\Serializer\SerializableInterface;

/**
 * Class RefundRequestModel
 * @package Team3\Communication\Request\Model
 * @JMS\AccessorOrder("alphabetical")
 */
class RefundRequestModel implements SerializableInterface
{
    /**
     * @var RefundModelInterface
     * @JMS\Type("Team3\Communication\Request\Model\RefundModel")
     */
    private $refund;

    /**
     * @var string
     * @JMS\Type("string")
     */
    private $orderId;

    /**
     * @param OrderInterface      $order
     * @param string              $description
     * @param string|null         $bankDescription
     * @param MoneyInterface|null $amount
     */
    public function __construct(
        OrderInterface $order,
        $description,
        $bankDescription = null,
        MoneyInterface $amount = null
    ) {
        $this->orderId = $order->getOrderId();
        $this->refund = new RefundModel($description, $bankDescription, $amount);
    }

    /**
     * @return RefundModelInterface
     */
    public function getRefund()
    {
        return $this->refund;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }
}
