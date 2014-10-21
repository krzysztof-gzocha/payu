<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Model\Buyer;

class Invoice implements InvoiceInterface
{
    /**
     * @var string
     */
    protected $street;

    /**
     * @var string
     */
    protected $postalCode;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $countryCode;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $recipientName;

    /**
     * @var string
     */
    protected $recipientEmail;

    /**
     * @var string
     */
    protected $recipientPhone;

    /**
     * @var string
     */
    protected $recipientTin;

    /**
     * @var bool
     */
    protected $eInvoiceRequested;

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return Invoice
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     *
     * @return Invoice
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isEInvoiceRequested()
    {
        return $this->eInvoiceRequested;
    }

    /**
     * @param boolean $eInvoiceRequested
     *
     * @return Invoice
     */
    public function setEInvoiceRequested($eInvoiceRequested)
    {
        $this->eInvoiceRequested = $eInvoiceRequested;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Invoice
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     *
     * @return Invoice
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getRecipientEmail()
    {
        return $this->recipientEmail;
    }

    /**
     * @param string $recipientEmail
     *
     * @return Invoice
     */
    public function setRecipientEmail($recipientEmail)
    {
        $this->recipientEmail = $recipientEmail;

        return $this;
    }

    /**
     * @return string
     */
    public function getRecipientName()
    {
        return $this->recipientName;
    }

    /**
     * @param string $recipientName
     *
     * @return Invoice
     */
    public function setRecipientName($recipientName)
    {
        $this->recipientName = $recipientName;

        return $this;
    }

    /**
     * @return string
     */
    public function getRecipientPhone()
    {
        return $this->recipientPhone;
    }

    /**
     * @param string $recipientPhone
     *
     * @return Invoice
     */
    public function setRecipientPhone($recipientPhone)
    {
        $this->recipientPhone = $recipientPhone;

        return $this;
    }

    /**
     * @return string
     */
    public function getTin()
    {
        return $this->recipientTin;
    }

    /**
     * @param string $recipientTin
     *
     * @return Invoice
     */
    public function setRecipientTin($recipientTin)
    {
        $this->recipientTin = $recipientTin;

        return $this;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     *
     * @return Invoice
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }
}
