<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order\Model\Buyer;

use Team3\Order\Model\IsFilledInterface;

interface BuyerInterface extends IsFilledInterface
{
    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param string $email
     *
     * @return Buyer
     */
    public function setEmail($email);

    /**
     * @return string
     */
    public function getFirstName();

    /**
     * @param string $firstName
     *
     * @return Buyer
     */
    public function setFirstName($firstName);

    /**
     * @return string
     */
    public function getLastName();

    /**
     * @param string $lastName
     *
     * @return Buyer
     */
    public function setLastName($lastName);

    /**
     * @return string
     */
    public function getPhone();

    /**
     * @param string $phone
     *
     * @return Buyer
     */
    public function setPhone($phone);

    /**
     * @return DeliveryInterface
     */
    public function getDelivery();

    /**
     * @param DeliveryInterface $delivery
     *
     * @return Buyer
     */
    public function setDelivery(DeliveryInterface $delivery);

    /**
     * @return InvoiceInterface
     */
    public function getInvoice();

    /**
     * @param InvoiceInterface $invoice
     *
     * @return Buyer
     */
    public function setInvoice(InvoiceInterface $invoice);
}
