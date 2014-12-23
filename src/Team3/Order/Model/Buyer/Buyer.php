<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Model\Buyer;

use Symfony\Component\Validator\Context\ExecutionContextInterface;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Buyer
 * @package Team3\Order\Model\Buyer
 * @JMS\AccessorOrder("alphabetical")
 */
class Buyer implements BuyerInterface
{
    /**
     * @var string
     * @Assert\Email()
     */
    protected $email;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     * @JMS\SerializedName("firstName")
     */
    protected $firstName;

    /**
     * @var string
     * @JMS\SerializedName("firstName")
     */
    protected $lastName;

    /**
     * @var DeliveryInterface
     * @JMS\Type("Team3\Order\Model\Buyer\Delivery")
     * @Assert\Valid
     * @JMS\Groups({"delivery"})
     */
    protected $delivery;

    /**
     * @var InvoiceInterface
     * @JMS\Type("Team3\Order\Model\Buyer\Invoice")
     * @Assert\Valid()
     * @JMS\Groups({"invoice"})
     */
    protected $invoice;

    public function __construct()
    {
        $this->delivery = new Delivery();
        $this->invoice = new Invoice();
    }

    /**
     * @return bool
     */
    public function isFilled()
    {
        return $this->firstName
            && $this->lastName
            && $this->email;
    }

    /**
     * @param ExecutionContextInterface $executionContext
     * @Assert\Callback()
     */
    public function validate(
        ExecutionContextInterface $executionContext
    ) {
        if (!$this->getFirstName()
            && !$this->getLastName()
            && !$this->getEmail()) {
            return;
        }

        if (!$this->getFirstName()
            || !$this->getLastName()
            || !$this->getEmail()) {
            $executionContext
                ->buildViolation(
                    sprintf('Object %s is not filled correctly', get_class($this))
                )
                ->addViolation();
        }
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
