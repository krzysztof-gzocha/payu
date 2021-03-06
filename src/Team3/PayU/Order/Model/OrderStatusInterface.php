<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Order\Model;

interface OrderStatusInterface
{
    const NEW_ORDER = 'NEW';
    const PENDING = 'PENDING';
    const WAITING_FOR_CONFIRMATION = 'WAITING_FOR_CONFIRMATION';
    const COMPLETED = 'COMPLETED';
    const CANCELED = 'CANCELED';
    const REJECTED = 'REJECTED';

    /**
     * @return string
     */
    public function getValue();

    /**
     * @return bool
     */
    public function isEmpty();

    /**
     * @return bool
     */
    public function isNew();

    /**
     * @return bool
     */
    public function isPending();

    /**
     * @return bool
     */
    public function isWaitingForConfirmation();

    /**
     * @return bool
     */
    public function isCompleted();

    /**
     * @return bool
     */
    public function isCanceled();

    /**
     * @return bool
     */
    public function isRejected();
}
