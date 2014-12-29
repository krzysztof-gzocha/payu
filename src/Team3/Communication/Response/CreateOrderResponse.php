<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication\Response;

use Team3\Communication\Request\OrderCreateRequest;
use Team3\Communication\Request\PayURequestInterface;
use Team3\Communication\Request\RequestStatus;
use JMS\Serializer\Annotation as JMS;

/**
 * Class CreateOrderResponse
 * @package Team3\Communication\Response
 */
class CreateOrderResponse implements ResponseInterface
{
    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("redirectUri")
     */
    private $redirectUri;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("orderId")
     */
    private $orderId;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("extOrderId")
     */
    private $extOrderId;

    /**
     * @var RequestStatus
     * @JMS\Type("Team3\Communication\Request\RequestStatus")
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
        return $payURequest instanceof OrderCreateRequest;
    }

    /**
     * @return string
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    /**
     * @param string $redirectUri
     *
     * @return CreateOrderResponse
     */
    public function setRedirectUri($redirectUri)
    {
        $this->redirectUri = $redirectUri;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     *
     * @return CreateOrderResponse
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return string
     */
    public function getExtOrderId()
    {
        return $this->extOrderId;
    }

    /**
     * @param string $extOrderId
     *
     * @return CreateOrderResponse
     */
    public function setExtOrderId($extOrderId)
    {
        $this->extOrderId = $extOrderId;

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
     * @return CreateOrderResponse
     */
    public function setRequestStatus(RequestStatus $requestStatus)
    {
        $this->requestStatus = $requestStatus;

        return $this;
    }
}
