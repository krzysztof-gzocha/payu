<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Response\Model;

use JMS\Serializer\Annotation as JMS;
use Team3\PayU\Order\Model\Money\Money;
use Team3\PayU\Order\Model\Money\MoneyInterface;

/**
 * Class RefundModel
 * @package Team3\PayU\Communication\Response\Model
 * @JMS\AccessorOrder("alphabetical")
 * @JMS\AccessType("public_methods")
 */
class RefundModel implements RefundModelInterface
{
    /**
     * @var string
     * @JMS\Type("string")
     */
    private $refundId;

    /**
     * @var string
     * @JMS\Type("string")
     */
    private $extRefundId;

    /**
     * @var MoneyInterface
     * @JMS\Type("integer")
     */
    private $amount;

    /**
     * @var string
     * @JMS\Type("string")
     */
    private $currencyCode;

    /**
     * @var string
     * @JMS\Type("string")
     */
    private $description;

    /**
     * @var \DateTime
     * @JMS\Type("string")
     */
    private $creationDateTime;

    /**
     * @var string
     * @JMS\Type("string")
     */
    private $status;

    /**
     * @var \DateTime
     * @JMS\Type("string")
     */
    private $statusDateTime;

    /**
     * @JMS\PostDeserialize()
     */
    public function setCurrencyInAmount()
    {
        if (null === $this->currencyCode) {
            return;
        }

        $this->amount = new Money(
            $this->getAmount()->getValue(),
            $this->currencyCode
        );
    }

    /**
     * @return bool
     */
    public function isPending()
    {
        return self::STATUS_PENDING === $this->status;
    }

    /**
     * @return bool
     */
    public function isCanceled()
    {
        return self::STATUS_CANCELED === $this->status;
    }

    /**
     * @return bool
     */
    public function isFinalized()
    {
        return self::STATUS_FINALIZED === $this->status;
    }

    /**
     * @return string
     */
    public function getRefundId()
    {
        return $this->refundId;
    }

    /**
     * @param string $refundId
     *
     * @return RefundModel
     */
    public function setRefundId($refundId)
    {
        $this->refundId = $refundId;

        return $this;
    }

    /**
     * @return string
     */
    public function getExtRefundId()
    {
        return $this->extRefundId;
    }

    /**
     * @param string $extRefundId
     *
     * @return RefundModel
     */
    public function setExtRefundId($extRefundId)
    {
        $this->extRefundId = $extRefundId;

        return $this;
    }

    /**
     * @return MoneyInterface
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = new Money($amount / 100);

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * @param string $currencyCode
     *
     * @return RefundModel
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return RefundModel
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDateTime()
    {
        return $this->creationDateTime;
    }

    /**
     * @param string $creationDateTime
     *
     * @return RefundModel
     */
    public function setCreationDateTime($creationDateTime)
    {
        $this->creationDateTime = new \DateTime($creationDateTime);

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return RefundModel
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStatusDateTime()
    {
        return $this->statusDateTime;
    }

    /**
     * @param string $statusDateTime
     *
     * @return RefundModel
     */
    public function setStatusDateTime($statusDateTime)
    {
        $this->statusDateTime = new \DateTime($statusDateTime);

        return $this;
    }
}
