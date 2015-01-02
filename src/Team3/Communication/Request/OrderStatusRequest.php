<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication\Request;

class OrderStatusRequest extends AbstractPayURequest
{
    /**
     * @var string
     */
    private $payUOrderId;

    /**
     * @param string $payUOrderId
     */
    public function __construct($payUOrderId)
    {
        $this->data = '';
        $this->payUOrderId = $payUOrderId;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return sprintf('/orders/%s', $this->payUOrderId);
    }
}
