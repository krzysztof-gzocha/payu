<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication\Response;

use Team3\Communication\Request\OrderStatusRequest;
use Team3\Communication\Request\PayURequestInterface;
use Team3\Communication\Request\Model\RequestStatus;
use Team3\Order\Model\OrderInterface;
use JMS\Serializer\Annotation as JMS;

class OrderStatusResponse implements ResponseInterface
{
    /**
     * @var OrderInterface[]
     * @JMS\Type("array<Team3\Order\Model\Order>")
     * @JMS\SerializedName("orders")
     */
    private $orders;

    /**
     * @var RequestStatus
     * @JMS\Type("Team3\Communication\Request\Model\RequestStatus")
     * @JMS\SerializedName("status")
     */
    private $requestStatus;

    /**
     * @param PayURequestInterface $payURequest
     *
     * @return bool
     */
    public function supports(PayURequestInterface $payURequest)
    {
        return $payURequest instanceof OrderStatusRequest;
    }

    /**
     * @return OrderInterface[]
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * @param OrderInterface[] $orders
     *
     * @return OrderStatusResponse
     */
    public function setOrders(array $orders)
    {
        $this->orders = $orders;

        return $this;
    }

    /**
     * @return RequestStatus
     */
    public function getRequestStatus()
    {
        return $this->requestStatus;
    }

    /**
     * @param RequestStatus $requestStatus
     *
     * @return OrderStatusResponse
     */
    public function setRequestStatus($requestStatus)
    {
        $this->requestStatus = $requestStatus;

        return $this;
    }

    /**
     * @return int
     */
    public function getOrdersCount()
    {
        return count($this->orders);
    }

    /**
     * @return OrderInterface
     * @throws NoOrdersInResponseException
     */
    public function getFirstOrder()
    {
        if (0 === $this->getOrdersCount()) {
            throw new NoOrdersInResponseException(
                'There is no order in OrderStatusResponse.'
            );
        }

        return $this->orders[0];
    }
}
