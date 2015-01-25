<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Order\Model\Buyer;

use Team3\PayU\Order\Model\IsFilledInterface;

interface InvoiceInterface extends IsFilledInterface
{
    /**
     * @return string
     */
    public function getCity();

    /**
     * @param string $city
     *
     * @return Invoice
     */
    public function setCity($city);

    /**
     * @return string
     */
    public function getCountryCode();

    /**
     * @param string $countryCode
     *
     * @return Invoice
     */
    public function setCountryCode($countryCode);

    /**
     * @return boolean
     */
    public function isEInvoiceRequested();

    /**
     * @param boolean $eInvoiceRequested
     *
     * @return Invoice
     */
    public function setEInvoiceRequested($eInvoiceRequested);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return Invoice
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getPostalCode();

    /**
     * @param string $postalCode
     *
     * @return Invoice
     */
    public function setPostalCode($postalCode);

    /**
     * @return string
     */
    public function getRecipientEmail();

    /**
     * @param string $recipientEmail
     *
     * @return Invoice
     */
    public function setRecipientEmail($recipientEmail);

    /**
     * @return string
     */
    public function getRecipientName();

    /**
     * @param string $recipientName
     *
     * @return Invoice
     */
    public function setRecipientName($recipientName);

    /**
     * @return string
     */
    public function getRecipientPhone();

    /**
     * @param string $recipientPhone
     *
     * @return Invoice
     */
    public function setRecipientPhone($recipientPhone);

    /**
     * @return string
     */
    public function getRecipientTin();

    /**
     * @param string $recipientTin
     *
     * @return Invoice
     */
    public function setRecipientTin($recipientTin);

    /**
     * @return string
     */
    public function getStreet();

    /**
     * @param string $street
     *
     * @return Invoice
     */
    public function setStreet($street);
}
