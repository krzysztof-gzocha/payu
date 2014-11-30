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
use Team3\Order\Model\Products\ProductCollectionInterface;
use Team3\Order\Model\ShippingMethods\ShippingMethodCollection;
use Team3\Order\Model\ShippingMethods\ShippingMethodCollectionInterface;

/**
 * Class Order
 * @package Team3\Order\Model
 * @JMS\AccessorOrder("alphabetical")
 * @JMS\AccessType("public_method")
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class Order implements OrderInterface
{
    use IsFilledTrait;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("customerIp")
     */
    protected $customerIp;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("extOrderId")
     */
    protected $orderId;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("merchantPosId")
     */
    protected $merchantPosId;

    /**
     * @var string
     * @JMS\Type("string")
     */
    protected $description;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("additionalDescription")
     */
    protected $additionalDescription;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("currencyCode")
     */
    protected $currencyCode;

    /**
     * @var MoneyInterface
     * @JMS\Type("string")
     * @JMS\SerializedName("totalAmount")
     * @JMS\Accessor(
     *      getter="getTotalAmountForSerialization",
     *      setter="setTotalAmountFromDeserialization")
     */
    protected $totalAmount;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("OpenPayU-Signature")
     */
    protected $signature;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("continueUrl")
     */
    protected $continueUrl;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("notifyUrl")
     */
    protected $notifyUrl;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("orderUrl")
     */
    protected $orderUrl;

    /**
     * @var BuyerInterface
     * @JMS\Type("Team3\Order\Model\Buyer\Buyer")
     */
    protected $buyer;

    /**
     * @var ProductCollectionInterface
     * @JMS\Type("array<Team3\Order\Model\Products\Product>")
     * @JMS\SerializedName("products")
     * @JMS\Accessor(setter="setProductCollectionFromDeserialization")
     */
    protected $productCollection;

    /**
     * @var ShippingMethodCollectionInterface
     * @JMS\Type("array<Team3\Order\Model\ShippingMethods\ShippingMethod>")
     * @JMS\SerializedName("shippingMethods")
     * @JMS\Accessor(setter="setShippingMethodCollectionFromDeserialization")
     */
    protected $shippingMethodCollection;

    /**
     * @var \DateTime
     * @JMS\Type("DateTime<'Y-m-d\TH:i:s.uP'>")
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
        $this->shippingMethodCollection = new ShippingMethodCollection();
        $this->status = new OrderStatus();
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
     * @return ProductCollectionInterface
     */
    public function getProductCollection()
    {
        return $this->productCollection;
    }

    /**
     * @param ProductCollectionInterface $productCollection
     *
     * @return Order
     */
    public function setProductCollection(
        ProductCollectionInterface $productCollection
    ) {
        $this->productCollection = $productCollection;

        return $this;
    }

    /**
     * @param array $products
     *
     * @return $this
     */
    public function setProductCollectionFromDeserialization(
        array $products
    ) {
        $this->setProductCollection(
            new ProductCollection($products)
        );

        return $this;
    }

    /**
     * @return ShippingMethodCollectionInterface
     */
    public function getShippingMethodCollection()
    {
        return $this->shippingMethodCollection;
    }

    /**
     * @param ShippingMethodCollectionInterface $shippingMethodCollection
     *
     * @return Order
     */
    public function setShippingMethodCollection(
        ShippingMethodCollectionInterface $shippingMethodCollection
    ) {
        $this->shippingMethodCollection = $shippingMethodCollection;

        return $this;
    }

    /**
     * @param array $shippingMethods
     *
     * @return $this
     */
    public function setShippingMethodCollectionFromDeserialization(
        array $shippingMethods
    ) {
        $this->setShippingMethodCollection(
            new ShippingMethodCollection($shippingMethods)
        );

        return $this;
    }

    /**
     * @return string
     */
    public function getAdditionalDescription()
    {
        return $this->additionalDescription;
    }

    /**
     * @param string $additionalDescription
     *
     * @return Order
     */
    public function setAdditionalDescription($additionalDescription)
    {
        $this->additionalDescription = $additionalDescription;

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
     * @return Order
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
     * @return Order
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
     * @return Order
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
     * @return Order
     */
    public function setMerchantPosId($merchantPosId)
    {
        $this->merchantPosId = $merchantPosId;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     *
     * @return Order
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

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
     * @return Order
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
     * @return Order
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
     * @return string
     */
    public function getContinueUrl()
    {
        return $this->continueUrl;
    }

    /**
     * @param string $continueUrl
     *
     * @return Order
     */
    public function setContinueUrl($continueUrl)
    {
        $this->continueUrl = $continueUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getNotifyUrl()
    {
        return $this->notifyUrl;
    }

    /**
     * @param string $notifyUrl
     *
     * @return Order
     */
    public function setNotifyUrl($notifyUrl)
    {
        $this->notifyUrl = $notifyUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrderUrl()
    {
        return $this->orderUrl;
    }

    /**
     * @param string $orderUrl
     *
     * @return Order
     */
    public function setOrderUrl($orderUrl)
    {
        $this->orderUrl = $orderUrl;

        return $this;
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
     * @return Order
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
     * @return Order
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
}
