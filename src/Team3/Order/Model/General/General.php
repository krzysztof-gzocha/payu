<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Model\General;

class General implements GeneralInterface
{
    const CUSTOMER_IP = 'customerIp';
    const ORDER_ID = 'extOrderId';
    const MERCHANT_POS_ID = 'merchantPosId';
    const DESCRIPTION = 'description';
    const ADDITIONAL_DESCRIPTION = 'additionalDescription';
    const CURRENCY_CODE = 'currencyCode';
    const TOTAL_AMOUNT = 'totalAmount';
    const SIGNATURE = 'OpenPayu-Signature';

    /**
     * @var string
     */
    protected $customerIp;

    /**
     * @var string
     */
    protected $orderId;

    /**
     * @var string
     */
    protected $merchantPosId;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $additionalDescription;

    /**
     * @var string
     */
    protected $currencyCode;

    /**
     * @var int
     */
    protected $totalAmount;

    /**
     * @var string
     */
    protected $signature;

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
     * @return General
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getAdditionalDescription()
    {
        return $this->additionalDescription;
    }

    /**
     * @param string $additionalDescription
     *
     * @return General
     */
    public function setAdditionalDescription($additionalDescription)
    {
        $this->additionalDescription = $additionalDescription;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * @param string $currencyCode
     *
     * @return General
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getCustomerIp()
    {
        return $this->customerIp;
    }

    /**
     * @param string $customerIp
     *
     * @return General
     */
    public function setCustomerIp($customerIp)
    {
        $this->customerIp = $customerIp;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getMerchantPosId()
    {
        return $this->merchantPosId;
    }

    /**
     * @param string $merchantPosId
     *
     * @return General
     */
    public function setMerchantPosId($merchantPosId)
    {
        $this->merchantPosId = $merchantPosId;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     *
     * @return General
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @param string $signature
     *
     * @return General
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * @param int $totalAmount
     *
     * @return General
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }
}
