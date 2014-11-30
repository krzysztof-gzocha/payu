<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Model;

class OrderStatus implements OrderStatusInterface
{
    const NEW_ORDER = 'NEW';
    const PENDING = 'PENDING';
    const WAITING_FOR_CONFIRMATION = 'WAITING_FOR_CONFIRMATION';
    const COMPLETED = 'COMPLETED';
    const CANCELED = 'CANCELED';
    const REJECTED = 'REJECTED';

    /**
     * @var string
     */
    protected $value;

    /**
     * @param string $value
     */
    public function __construct($value = null)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return null === $this->value;
    }

    /**
     * @return bool
     */
    public function isNew()
    {
        return self::NEW_ORDER === $this->value;
    }

    /**
     * @return bool
     */
    public function isPending()
    {
        return self::PENDING === $this->value;
    }

    /**
     * @return bool
     */
    public function isWaitingForConfirmation()
    {
        return self::WAITING_FOR_CONFIRMATION === $this->value;
    }

    /**
     * @return bool
     */
    public function isCompleted()
    {
        return self::COMPLETED === $this->value;
    }

    /**
     * @return bool
     */
    public function isCanceled()
    {
        return self::CANCELED === $this->value;
    }

    /**
     * @return bool
     */
    public function isRejected()
    {
        return self::REJECTED === $this->value;
    }
}
