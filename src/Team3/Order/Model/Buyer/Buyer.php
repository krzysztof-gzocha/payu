<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Model\Buyer;

class Buyer implements BuyerInterface
{
    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var DeliveryInterface
     */
    protected $delivery;

    /**
     * @var InvoiceInterface
     */
    protected $invoice;

    public function __construct()
    {
        $this->delivery = new Delivery();
        $this->invoice = new Invoice();
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return Buyer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return Buyer
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return Buyer
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     *
     * @return Buyer
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return DeliveryInterface
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * @param DeliveryInterface $delivery
     *
     * @return Buyer
     */
    public function setDelivery(DeliveryInterface $delivery)
    {
        $this->delivery = $delivery;

        return $this;
    }

    /**
     * @return InvoiceInterface
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * @param InvoiceInterface $invoice
     *
     * @return Buyer
     */
    public function setInvoice(InvoiceInterface $invoice)
    {
        $this->invoice = $invoice;

        return $this;
    }
}
