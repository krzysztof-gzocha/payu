<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Model\Money;

use Symfony\Component\Validator\Constraints as Assert;

class Money implements MoneyInterface
{
    /**
     * @var float
     * @Assert\GreaterThan(0)
     */
    protected $value;

    /**
     * @var string
     * @Assert\Length(min="2", max="2")
     */
    protected $currency;

    /**
     * @var int
     * @Assert\GreaterThan(0)
     */
    protected $precision;

    /**
     * @param float  $value
     * @param string $currency
     * @param int    $precision
     *
     * @throws WrongMoneyValueException
     */
    public function __construct($value, $currency = null, $precision = 2)
    {
        $this->checkValueValidity($value);

        $this->value = $value;
        $this->currency = $currency;
        $this->precision = $precision;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if (null === $this->currency) {
            return (string) round($this->value, $this->precision);
        }

        return sprintf(
            '%s %s',
            round($this->value, $this->precision),
            $this->currency
        );
    }

    /**
     * @inheritdoc
     */
    public function getValue()
    {
        return (float) $this->value;
    }

    /**
     * When precision is set to 2 this method will transforms 12.34 into 1234.
     * @param int $precision
     *
     * @return int
     */
    public function getValueWithoutSeparation($precision = 2)
    {
        return (int) sprintf('%d', $this->getValue() * pow(10, $precision));
    }

    /**
     * @param int|float $value
     *
     * @throws WrongMoneyValueException
     */
    protected function checkValueValidity($value)
    {
        if (!is_numeric($value)) {
            throw new WrongMoneyValueException(sprintf(
                'Value passed to %s should be numeric, but is %s',
                __CLASS__,
                gettype($value)
            ));
        }
    }
}
