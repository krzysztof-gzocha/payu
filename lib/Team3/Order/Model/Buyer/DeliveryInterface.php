<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order\Model\Buyer;

interface DeliveryInterface
{
    /**
     * @return string
     */
    public function getCity();

    /**
     * @param string $city
     *
     * @return Delivery
     */
    public function setCity($city);

    /**
     * @return string
     */
    public function getCountryCode();

    /**
     * @param string $countryCode
     *
     * @return Delivery
     */
    public function setCountryCode($countryCode);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return Delivery
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getPostalCode();

    /**
     * @param string $postalCode
     *
     * @return Delivery
     */
    public function setPostalCode($postalCode);

    /**
     * @return string
     */
    public function getRecipientEmail();

    /**
     * @param string $recipientEmail
     *
     * @return Delivery
     */
    public function setRecipientEmail($recipientEmail);

    /**
     * @return string
     */
    public function getRecipientName();

    /**
     * @param string $recipientName
     *
     * @return Delivery
     */
    public function setRecipientName($recipientName);

    /**
     * @return string
     */
    public function getRecipientPhone();

    /**
     * @param string $recipientPhone
     *
     * @return Delivery
     */
    public function setRecipientPhone($recipientPhone);

    /**
     * @return string
     */
    public function getStreet();

    /**
     * @param string $street
     *
     * @return Delivery
     */
    public function setStreet($street);
}
