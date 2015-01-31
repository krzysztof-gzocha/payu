<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\Communication\Response;

use JMS\Serializer\Annotation as JMS;
use Team3\PayU\Communication\Request\Model\RequestStatus;
use Team3\PayU\Communication\Request\OrderCancelRequest;
use Team3\PayU\Communication\Request\PayURequestInterface;

/**
 * This object will be returned from {@link RequestProcess}
 * if {@link OrderCancelRequest} will be passed.
 *
 * Class OrderCancelResponse
 * @package Team3\PayU\Communication\Response
 */
class OrderCancelResponse implements ResponseInterface
{
    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\Accessor(
     *      setter="setPayUOrderId",
     *      getter="getPayUOrderId"
     * )
     */
    private $orderId;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\Accessor(
     *      setter="setOrderId",
     *      getter="getOrderId"
     * )
     */
    private $extOrderId;

    /**
     * @var RequestStatus
     * @JMS\Type("Team3\PayU\Communication\Request\Model\RequestStatus")
     */
    private $status;

    /**
     * @param PayURequestInterface $payURequest
     *
     * @return bool
     */
    public function supports(PayURequestInterface $payURequest)
    {
        return $payURequest instanceof OrderCancelRequest;
    }

    /**
     * @return string
     */
    public function getPayUOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     *
     * @return OrderCancelResponse
     */
    public function setPayUOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->extOrderId;
    }

    /**
     * @param string $orderId
     *
     * @return OrderCancelResponse
     */
    public function setOrderId($orderId)
    {
        $this->extOrderId = $orderId;

        return $this;
    }

    /**
     * @return RequestStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param RequestStatus $status
     *
     * @return OrderCancelResponse
     */
    public function setStatus(RequestStatus $status)
    {
        $this->status = $status;

        return $this;
    }
}
