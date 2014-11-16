<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer\Adapter;

use JMS\Serializer\Annotation as JMS;
use Team3\Order\Model\Buyer\InvoiceInterface;

/**
 * Class InvoiceAdapter
 * @package Team3\Order\Serializer\Adapter
 * @JMS\ExclusionPolicy("all")
 */
class InvoiceAdapter
{
    /**
     * @var InvoiceInterface
     */
    protected $invoice;

    /**
     * @param InvoiceInterface $invoice
     */
    public function __construct(InvoiceInterface $invoice)
    {
        $this->invoice = $invoice;
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
        return $this->invoice->getCity();
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
        return $this->invoice->getCountryCode();
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
        return $this->invoice->getName();
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
        return $this->invoice->getPostalCode();
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
        return $this->invoice->getRecipientEmail();
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
        return $this->invoice->getRecipientName();
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
        return $this->invoice->getRecipientPhone();
    }

    /**
     * @return string
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("string")
     * @JMS\SerializedName("tin")
     */
    public function getTin()
    {
        return $this->invoice->getTin();
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
        return $this->invoice->getStreet();
    }

    /**
     * @return bool
     *
     * @JMS\VirtualProperty()
     * @JMS\Type("boolean")
     * @JMS\SerializedName("einvoiceRequested")
     */
    public function isEInvoiceRequested()
    {
        return $this->invoice->isEInvoiceRequested();
    }
}
