<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Model;

use JMS\Serializer\Annotation as JMS;
use Team3\Order\Model\Buyer\Buyer;
use Team3\Order\Model\Buyer\BuyerInterface;
use Team3\Order\Model\Money\Money;
use Team3\Order\Model\Money\MoneyInterface;
use Team3\Order\Model\Products\ProductCollection;
use Team3\Order\Model\ShippingMethods\ShippingMethodCollection;
use Team3\Order\Model\Traits\OrderIdentificationParametersTrait;
use Team3\Order\Model\Traits\ProductCollectionTrait;
use Team3\Order\Model\Traits\ShippingMethodCollectionTrait;
use Team3\Order\Model\Traits\UrlsTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Order
 * @package Team3\Order\Model
 * @JMS\AccessorOrder("alphabetical")
 * @JMS\AccessType("public_method")
 */
class Order implements OrderInterface
{
    use IsFilledTrait;
    use UrlsTrait;
    use ProductCollectionTrait;
    use ShippingMethodCollectionTrait;
    use OrderIdentificationParametersTrait;

    /**
     * @var BuyerInterface
     * @JMS\Type("Team3\Order\Model\Buyer\Buyer")
     * @JMS\Groups({"buyer"})
     * @Assert\Valid()
     */
    protected $buyer;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("customerIp")
     * @Assert\Ip()
     * @Assert\NotBlank()
     */
    protected $customerIp;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("merchantPosId")
     * @Assert\NotBlank()
     */
    protected $merchantPosId;

    /**
     * @var string
     * @JMS\Type("string")
     * @Assert\NotBlank()
     */
    protected $description;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\Accessor(
     *      getter="getAdditionalDescription",
     *      setter="setAdditionalDescription"
     * )
     * @JMS\SerializedName("additionalDescription")
     */
    protected $extraDescription;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("currencyCode")
     * @Assert\NotBlank()
     */
    protected $currencyCode;

    /**
     * @var MoneyInterface
     * @JMS\Type("integer")
     * @JMS\SerializedName("totalAmount")
     * @JMS\Accessor(
     *      getter="getTotalAmountForSerialization",
     *      setter="setTotalAmountFromDeserialization"
     * )
     * @Assert\Type(type="object")
     * @Assert\NotBlank()
     * @Assert\Valid
     */
    protected $totalAmount;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("OpenPayU-Signature")
     * @Assert\NotBlank()
     */
    protected $signature;

    /**
     * @var \DateTime
     * @JMS\Type("string")
     * @JMS\Accessor(
     *      setter="setCreatedAtFromDeserialization"
     * )
     * @JMS\SerializedName("orderCreateDate")
     */
    protected $createdAt;

    /**
     * @var OrderStatusInterface
     * @JMS\Type("string")
     * @JMS\Accessor(
     *      getter="getStatusForSerialization",
     *      setter="setStatusFromDeserialization"
     * )
     */
    protected $status;

    public function __construct()
    {
        $this->buyer = new Buyer();
        $this->productCollection = new ProductCollection();
        $this->shippingCollection = new ShippingMethodCollection();
        $this->status = new OrderStatus();
        $this->totalAmount = new Money(0);
    }

    /**
     * @return BuyerInterface
     */
    public function getBuyer()
    {
        return $this->buyer;
    }

    /**
     * @param BuyerInterface $buyer
     *
     * @return Order
     */
    public function setBuyer(BuyerInterface $buyer)
    {
        $this->buyer = $buyer;

        return $this;
    }

    /**
     * @return string
     */
    public function getAdditionalDescription()
    {
        return $this->extraDescription;
    }

    /**
     * @param string $additionalDescription
     *
     * @return $this
     */
    public function setAdditionalDescription($additionalDescription)
    {
        $this->extraDescription = $additionalDescription;

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
     * @return $this
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerIp()
    {
        return $this->customerIp;
    }

    /**
     * @param string $customerIp
     *
     * @return $this
     */
    public function setCustomerIp($customerIp)
    {
        $this->customerIp = $customerIp;

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
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantPosId()
    {
        return $this->merchantPosId;
    }

    /**
     * @param string $merchantPosId
     *
     * @return $this
     */
    public function setMerchantPosId($merchantPosId)
    {
        $this->merchantPosId = $merchantPosId;

        return $this;
    }

    /**
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @param string $signature
     *
     * @return $this
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * @return MoneyInterface
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * @param MoneyInterface $totalAmount
     *
     * @return $this
     */
    public function setTotalAmount(MoneyInterface $totalAmount)
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    /**
     * @param int $price
     *
     * @return $this
     */
    public function setTotalAmountFromDeserialization($price)
    {
        $this->totalAmount = new Money($price / 100);

        return $this;
    }

    /**
     * @return int
     */
    public function getTotalAmountForSerialization()
    {
        return $this->totalAmount->getValueWithoutSeparation(2);
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return OrderStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getStatusForSerialization()
    {
        return $this->status->getValue();
    }

    /**
     * @param OrderStatusInterface $status
     *
     * @return $this
     */
    public function setStatus(OrderStatusInterface $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param string $status
     *
     * @return $this
     */
    public function setStatusFromDeserialization($status)
    {
        $this->status = new OrderStatus($status);

        return $this;
    }

    /**
     * PayU is using different datetime formats for different things.
     * This method will capture any datetime format and parse it into DateTime object
     * @param string $createdAt
     *
     * @return $this
     */
    public function setCreatedAtFromDeserialization($createdAt)
    {
        $this->createdAt = new \DateTime($createdAt);

        return $this;
    }
}
