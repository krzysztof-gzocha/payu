<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order\Model;

interface OrderStatusInterface
{
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
