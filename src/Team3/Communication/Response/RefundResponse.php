<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication\Response;

use Team3\Communication\Request\PayURequestInterface;
use Team3\Communication\Request\RefundRequest;
use Team3\Communication\Request\RequestStatus;
use JMS\Serializer\Annotation as JMS;
use Team3\Communication\Response\Model\RefundModelInterface;

/**
 * Class RefundResponse
 * @package Team3\Communication\Response
 * @JMS\AccessorOrder("alphabetical")
 */
class RefundResponse implements ResponseInterface
{
    /**
     * @var string
     * @JMS\Type("string")
     */
    private $orderId;

    /**
     * @var RefundModelInterface
     * @JMS\Type("Team3\Communication\Response\Model\RefundModel")
     */
    private $refund;

    /**
     * @var RequestStatus
     * @JMS\Type("Team3\Communication\Request\RequestStatus")
     */
    private $status;

    /**
     * @param PayURequestInterface $payURequest
     *
     * @return bool
     */
    public function supports(PayURequestInterface $payURequest)
    {
        return $payURequest instanceof RefundRequest;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @return RefundModelInterface
     */
    public function getRefund()
    {
        return $this->refund;
    }

    /**
     * @return RequestStatus
     */
    public function getStatus()
    {
        return $this->status;
    }
}
