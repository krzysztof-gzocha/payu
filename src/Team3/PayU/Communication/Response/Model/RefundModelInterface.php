<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Response\Model;

use Team3\PayU\Order\Model\Money\MoneyInterface;

/**
 * Class RefundModel
 * @package Team3\PayU\Communication\Response\Model
 */
interface RefundModelInterface
{
    const STATUS_PENDING = 'PENDING';
    const STATUS_CANCELED = 'CANCELED';
    const STATUS_FINALIZED = 'FINALIZED';

    /**
     * @return bool
     */
    public function isPending();

    /**
     * @return bool
     */
    public function isCanceled();

    /**
     * @return bool
     */
    public function isFinalized();

    /**
     * @return string
     */
    public function getRefundId();

    /**
     * @return string
     */
    public function getExtRefundId();

    /**
     * @return MoneyInterface
     */
    public function getAmount();

    /**
     * @return string
     */
    public function getCurrencyCode();

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @return \DateTime
     */
    public function getCreationDateTime();

    /**
     * @return string
     */
    public function getStatus();

    /**
     * @return \DateTime
     */
    public function getStatusDateTime();
}
