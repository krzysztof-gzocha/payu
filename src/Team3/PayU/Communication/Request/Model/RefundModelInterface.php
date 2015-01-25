<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Request\Model;

use Team3\PayU\Order\Model\Money\MoneyInterface;

/**
 * Class RefundModel
 * @package Team3\PayU\Communication\Request
 */
interface RefundModelInterface
{
    /**
     * @return string
     */
    public function getDescription();

    /**
     * @return string|null
     */
    public function getBankDescription();

    /**
     * @return MoneyInterface|null
     */
    public function getAmount();
}
