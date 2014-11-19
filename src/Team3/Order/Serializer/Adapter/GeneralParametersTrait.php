<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer\Adapter;

trait GeneralParametersTrait
{
    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("extOrderId")
     */
    public function getId()
    {
        return $this->order->getGeneral()->getOrderId();
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("customerIp")
     */
    public function getCustomerIp()
    {
        return $this->order->getGeneral()->getCustomerIp();
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("merchantPosId")
     */
    public function getMerchantPosId()
    {
        return $this->order->getGeneral()->getMerchantPosId();
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("description")
     */
    public function getDescription()
    {
        return $this->order->getGeneral()->getDescription();
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("currencyCode")
     */
    public function getCurrencyCode()
    {
        return $this->order->getGeneral()->getCurrencyCode();
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("integer")
     * @JMS\SerializedName("totalAmount")
     */
    public function getTotalAmount()
    {
        return $this->order->getGeneral()->getTotalAmount()->getValueWithoutSeparation(2);
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("additionalDescription")
     */
    public function getAdditionalDescription()
    {
        return $this->order->getGeneral()->getAdditionalDescription();
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("OpenPayU-Signature")
     */
    public function getSignature()
    {
        return $this->order->getGeneral()->getSignature();
    }
}
