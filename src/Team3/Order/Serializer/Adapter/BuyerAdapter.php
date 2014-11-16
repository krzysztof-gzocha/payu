<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer\Adapter;

use JMS\Serializer\Annotation as JMS;
use Team3\Order\Model\Buyer\BuyerInterface;
use Team3\Order\Model\Buyer\DeliveryInterface;
use Team3\Order\Model\Buyer\InvoiceInterface;

/**
 * Class BuyerAdapter
 * @package Team3\Order\Serializer\Adapter
 * @JMS\ExclusionPolicy("all")
 */
class BuyerAdapter
{
    /**
     * @var BuyerInterface
     */
    protected $buyer;

    /**
     * @param BuyerInterface $buyer
     */
    public function __construct(BuyerInterface $buyer)
    {
        $this->buyer = $buyer;
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("email")
     */
    public function getEmail()
    {
        return $this->buyer->getEmail();
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("firstName")
     */
    public function getFirstName()
    {
        return $this->buyer->getFirstName();
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("lastName")
     */
    public function getLastName()
    {
        return $this->buyer->getLastName();
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("phone")
     */
    public function getPhone()
    {
        return $this->buyer->getPhone();
    }

    /**
     * @return DeliveryInterface
     */
    public function getDelivery()
    {
        // TODO: Implement getDelivery() method.
    }

    /**
     * @return InvoiceInterface
     */
    public function getInvoice()
    {
        // TODO: Implement getInvoice() method.
    }
}
