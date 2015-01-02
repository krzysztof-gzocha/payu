<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Model\Traits;

trait OrderIdentificationParametersTrait
{
    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("extOrderId")
     * @JMS\Accessor(
     *      setter="setOrderId",
     *      getter="getOrderId"
     * )
     */
    protected $extOrderId;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("orderId")
     */
    protected $payUOrderId;

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->extOrderId;
    }

    /**
     * @param string $orderId
     *
     * @return $this
     */
    public function setOrderId($orderId)
    {
        $this->extOrderId = $orderId;

        return $this;
    }

    /**
     * @return string
     */
    public function getPayUOrderId()
    {
        return $this->payUOrderId;
    }

    /**
     * @param string $payUOrderId
     *
     * @return $this
     */
    public function setPayUOrderId($payUOrderId)
    {
        $this->payUOrderId = $payUOrderId;

        return $this;
    }
}
