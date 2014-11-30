<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order\Model;

use Team3\Order\Model\Buyer\BuyerInterface;
use Team3\Order\Model\Money\MoneyInterface;
use Team3\Order\Model\Products\ProductCollectionInterface;
use Team3\Order\Model\ShippingMethods\ShippingMethodCollectionInterface;

interface OrderInterface extends IsFilledInterface
{
    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description);

    /**
     * @string
     */
    public function getAdditionalDescription();

    /**
     * @param string $additionalDescription
     *
     * @return $this
     */
    public function setAdditionalDescription($additionalDescription);

    /**
     * @inheritdoc
     */
    public function getCurrencyCode();

    /**
     * @param string $currencyCode
     *
     * @return $this
     */
    public function setCurrencyCode($currencyCode);

    /**
     * @inheritdoc
     */
    public function getCustomerIp();

    /**
     * @param string $customerIp
     *
     * @return $this
     */
    public function setCustomerIp($customerIp);

    /**
     * @inheritdoc
     */
    public function getMerchantPosId();

    /**
     * @param string $merchantPosId
     *
     * @return $this
     */
    public function setMerchantPosId($merchantPosId);

    /**
     * @inheritdoc
     */
    public function getOrderId();

    /**
     * @param string $orderId
     *
     * @return $this
     */
    public function setOrderId($orderId);

    /**
     * @inheritdoc
     */
    public function getSignature();

    /**
     * @param string $signature
     *
     * @return $this
     */
    public function setSignature($signature);

    /**
     * @return MoneyInterface
     */
    public function getTotalAmount();

    /**
     * @param MoneyInterface $totalAmount
     *
     * @return $this
     */
    public function setTotalAmount(MoneyInterface $totalAmount);

    /**
     * @return BuyerInterface
     */
    public function getBuyer();

    /**
     * @param BuyerInterface $buyer
     *
     * @return Order
     */
    public function setBuyer(BuyerInterface $buyer);

    /**
     * @return ProductCollectionInterface
     */
    public function getProductCollection();

    /**
     * @param ProductCollectionInterface $productCollection
     *
     * @return Order
     */
    public function setProductCollection(ProductCollectionInterface $productCollection);

    /**
     * @return ShippingMethodCollectionInterface
     */
    public function getShippingMethodCollection();

    /**
     * @param ShippingMethodCollectionInterface $shippingMethodCollection
     *
     * @return Order
     */
    public function setShippingMethodCollection(ShippingMethodCollectionInterface $shippingMethodCollection);

    /**
     * @return string
     */
    public function getContinueUrl();

    /**
     * @param string $continueUrl
     *
     * @return $this
     */
    public function setContinueUrl($continueUrl);

    /**
     * @return string
     */
    public function getNotifyUrl();

    /**
     * @param string $notifyUrl
     *
     * @return $this
     */
    public function setNotifyUrl($notifyUrl);

    /**
     * @return string
     */
    public function getOrderUrl();

    /**
     * @param string $orderUrl
     *
     * @return $this
     */
    public function setOrderUrl($orderUrl);

    /**
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * @param \DateTime $createdAt
     *
     * @return Order
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * @return OrderStatusInterface
     */
    public function getStatus();

    /**
     * @param OrderStatusInterface $status
     *
     * @return Order
     */
    public function setStatus(OrderStatusInterface $status);
}
