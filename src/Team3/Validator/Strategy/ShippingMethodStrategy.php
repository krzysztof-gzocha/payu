<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Validator\Strategy;

use Team3\Order\Model\Money\MoneyInterface;
use Team3\Order\Model\OrderInterface;
use Team3\Order\Model\ShippingMethods\ShippingMethodCollectionInterface;
use Team3\Order\Model\ShippingMethods\ShippingMethodInterface;
use Team3\Validator\AbstractValidator;

class ShippingMethodStrategy extends AbstractValidator
{
    const MINIMAL_PRICE = 0.01;
    const COUNTRY_CODE_LENGTH = 2;

    /**
     * @inheritdoc
     */
    public function validate(OrderInterface $order)
    {
        $shippingMethods = $order->getShippingMethodCollection();

        if ($this->shouldNotValidate($shippingMethods)) {
            return true;
        }

        /** @var ShippingMethodInterface $shippingMethod */
        foreach ($shippingMethods as $shippingMethod) {
            $this
                ->checkCountry($shippingMethod)
                ->checkName($shippingMethod)
                ->checkPrice($shippingMethod);
        }

        return $this->hasNoErrors();
    }

    /**
     * @param ShippingMethodCollectionInterface $shippingMethodCollection
     *
     * @return bool
     */
    protected function shouldNotValidate(
        ShippingMethodCollectionInterface $shippingMethodCollection
    ) {
        return 0 === $shippingMethodCollection->count();
    }

    /**
     * @param ShippingMethodInterface $shippingMethod
     *
     * @return $this
     */
    protected function checkCountry(ShippingMethodInterface $shippingMethod)
    {
        if (self::COUNTRY_CODE_LENGTH !== mb_strlen($shippingMethod->getCountry())) {
            $this->addValidationError(
                $shippingMethod,
                sprintf(
                    'Country code in shipping method should have exactly %d chars',
                    self::COUNTRY_CODE_LENGTH
                ),
                'country'
            );
        }

        return $this;
    }

    /**
     * @param ShippingMethodInterface $shippingMethod
     *
     * @return $this
     */
    protected function checkName(ShippingMethodInterface $shippingMethod)
    {
        if (1 > mb_strlen($shippingMethod->getName())) {
            $this->addValidationError(
                $shippingMethod,
                'Name of shipping method can not be empty',
                'name'
            );
        }

        return $this;
    }

    /**
     * @param ShippingMethodInterface $shippingMethod
     *
     * @return $this
     */
    protected function checkPrice(ShippingMethodInterface $shippingMethod)
    {
        if (!$shippingMethod->getPrice() instanceof MoneyInterface) {
            $this->addValidationError(
                $shippingMethod,
                'Shipping methods price should be type of MoneyInterface',
                'price'
            );

            return $this;
        }

        $price = $shippingMethod->getPrice()->getValue();

        if (1 === bccomp(self::MINIMAL_PRICE, $price)) {
            $this->addValidationError(
                $shippingMethod,
                sprintf(
                    'Price of shipping method should not be less then %s',
                    self::MINIMAL_PRICE
                ),
                'price'
            );
        }

        return $this;
    }
}
