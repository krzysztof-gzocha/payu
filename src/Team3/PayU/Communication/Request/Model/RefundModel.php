<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Request\Model;

use Team3\PayU\Order\Model\Money\Money;
use Team3\PayU\Order\Model\Money\MoneyInterface;
use JMS\Serializer\Annotation as JMS;

/**
 * Class RefundModel
 * @package Team3\PayU\Communication\Request
 * @JMS\AccessorOrder("alphabetical")
 * @JMS\AccessType("public_method")
 */
class RefundModel implements RefundModelInterface
{
    /**
     * @var string
     * @JMS\Type("string")
     */
    private $description;

    /**
     * @var string
     * @JMS\Type("string")
     */
    private $bankDescription;

    /**
     * @var MoneyInterface|null
     * @JMS\Type("integer")
     * @JMS\Accessor(
     *                          getter="getAmountForSerialization",
     *                          setter="setAmountFromDeserialization"
     *                          )
     */
    private $amount;

    /**
     * @param string              $description
     * @param string|null         $bankDescription
     * @param MoneyInterface|null $amount
     */
    public function __construct(
        $description,
        $bankDescription = null,
        MoneyInterface $amount = null
    ) {
        $this->description = $description;
        $this->bankDescription = $bankDescription;
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return RefundModelInterface
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBankDescription()
    {
        return $this->bankDescription;
    }

    /**
     * @param string $bankDescription
     *
     * @return RefundModel
     */
    public function setBankDescription($bankDescription)
    {
        $this->bankDescription = $bankDescription;

        return $this;
    }

    /**
     * @return MoneyInterface|null
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return int|null
     */
    public function getAmountForSerialization()
    {
        if ($this->amount instanceof MoneyInterface) {
            return $this->amount->getValueWithoutSeparation(2);
        }

        return $this->amount;
    }

    /**
     * @param int $amount
     *
     * @return RefundModelInterface
     */
    public function setAmountFromDeserialization($amount)
    {
        $this->amount = new Money($amount / 100);

        return $this;
    }
}
