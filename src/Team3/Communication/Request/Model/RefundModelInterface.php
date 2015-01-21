<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Communication\Request\Model;

use Team3\Order\Model\Money\MoneyInterface;

/**
 * Class RefundModel
 * @package Team3\Communication\Request
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
