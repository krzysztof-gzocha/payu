<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Validator;

use Team3\Order\Model\Money\MoneyInterface;

trait ValidationHelperTrait
{
    /**
     * @return float
     */
    protected function getMinimalPrice()
    {
        return 0.01;
    }

    /**
     * @param string $string
     *
     * @return bool
     */
    protected function isStringEmpty($string)
    {
        return 1 > mb_strlen($string);
    }

    /**
     * @param string $countryCode
     *
     * @return int
     */
    protected function isCountryCodeIncorrect($countryCode)
    {
        return 2 !== mb_strlen($countryCode);
    }

    /**
     * @param MoneyInterface $money
     *
     * @return bool
     */
    protected function isMoneyNegative(MoneyInterface $money)
    {
        return 1 === bccomp($this->getMinimalPrice(), $money->getValue());
    }
}
