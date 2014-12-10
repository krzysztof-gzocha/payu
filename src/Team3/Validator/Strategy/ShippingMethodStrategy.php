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
use Team3\Validator\ValidationHelperTrait;

class ShippingMethodStrategy extends AbstractValidator
{
    use ValidationHelperTrait;

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
        if ($this->isCountryCodeIncorrect($shippingMethod->getCountry())) {
            $this->addValidationError(
                $shippingMethod,
                'Country code in shipping method can not be empty',
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
        if ($this->isStringEmpty($shippingMethod->getName())) {
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

        if ($this->isMoneyNegative($shippingMethod->getPrice())) {
            $this->addValidationError(
                $shippingMethod,
                sprintf(
                    'Price of shipping method should not be less then %s',
                    $this->getMinimalPrice()
                ),
                'price'
            );
        }

        return $this;
    }
}
