<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Validator\Strategy;

use Team3\Order\Model\Buyer\DeliveryInterface;
use Team3\Order\Model\OrderInterface;
use Team3\Validator\AbstractValidator;
use Team3\Validator\ValidationHelperTrait;

class DeliveryValidatorStrategy extends AbstractValidator
{
    use ValidationHelperTrait;

    /**
     * @inheritdoc
     */
    public function validate(OrderInterface $order)
    {
        $delivery = $order->getBuyer()->getDelivery();

        if ($this->shouldNotValidate($delivery)) {
            return true;
        }

        $this
            ->checkStreet($delivery)
            ->checkCity($delivery)
            ->checkCountryCode($delivery)
            ->checkPostalCode($delivery);

        return $this->hasNoErrors();
    }

    /**
     * @param DeliveryInterface $delivery
     *
     * @return bool
     */
    protected function shouldNotValidate(DeliveryInterface $delivery)
    {
        return !$delivery->getStreet()
            && !$delivery->getPostalCode()
            && !$delivery->getCountryCode()
            && !$delivery->getCity();
    }

    /**
     * @param DeliveryInterface $delivery
     *
     * @return $this
     */
    protected function checkStreet(DeliveryInterface $delivery)
    {
        if ($this->isStringEmpty($delivery->getStreet())) {
            $this->addValidationError(
                $delivery,
                'Street name of the delivery can not be empty',
                'street'
            );
        }

        return $this;
    }

    /**
     * @param DeliveryInterface $delivery
     *
     * @return $this
     */
    protected function checkPostalCode(DeliveryInterface $delivery)
    {
        if ($this->isStringEmpty($delivery->getPostalCode())) {
            $this->addValidationError(
                $delivery,
                'Postal code of the delivery can not be empty',
                'postalCode'
            );
        }

        return $this;
    }

    /**
     * @param DeliveryInterface $delivery
     *
     * @return $this
     */
    protected function checkCity(DeliveryInterface $delivery)
    {
        if ($this->isStringEmpty($delivery->getCity())) {
            $this->addValidationError(
                $delivery,
                'City name of the delivery can not be empty',
                'city'
            );
        }

        return $this;
    }

    /**
     * @param DeliveryInterface $delivery
     *
     * @return $this
     */
    protected function checkCountryCode(DeliveryInterface $delivery)
    {
        if ($this->isCountryCodeIncorrect($delivery->getCountryCode())) {
            $this->addValidationError(
                $delivery,
                'Country code of the delivery can not be empty',
                'countryCode'
            );
        }

        return $this;
    }
}
