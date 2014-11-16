<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer\Adapter;

use JMS\Serializer\Annotation as JMS;
use Team3\Order\Model\Buyer\DeliveryInterface;

/**
 * Class DeliveryAdapter
 * @package Team3\Order\Serializer\Adapter
 * @JMS\ExclusionPolicy("all")
 */
class DeliveryAdapter
{
    /**
     * @var DeliveryInterface
     */
    protected $delivery;

    /**
     * @param DeliveryInterface $delivery
     */
    public function __construct(DeliveryInterface $delivery)
    {
        $this->delivery = $delivery;
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("city")
     */
    public function getCity()
    {
        return $this->delivery->getCity();
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("countryCode")
     */
    public function getCountryCode()
    {
        return $this->delivery->getCountryCode();
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("name")
     */
    public function getName()
    {
        return $this->delivery->getName();
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("postalCode")
     */
    public function getPostalCode()
    {
        return $this->delivery->getPostalCode();
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("recipientEmail")
     */
    public function getRecipientEmail()
    {
        return $this->delivery->getRecipientEmail();
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("recipientName")
     */
    public function getRecipientName()
    {
        return $this->delivery->getRecipientName();
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("recipientPhone")
     */
    public function getRecipientPhone()
    {
        return $this->delivery->getRecipientPhone();
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("street")
     */
    public function getStreet()
    {
        return $this->delivery->getStreet();
    }
}
