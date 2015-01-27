<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Response;

use Team3\PayU\Communication\Request\OrderCreateRequest;
use Team3\PayU\Communication\Request\PayURequestInterface;
use Team3\PayU\Communication\Request\Model\RequestStatus;
use JMS\Serializer\Annotation as JMS;

/**
 * Class OrderCreateResponse
 * @package Team3\PayU\Communication\Response
 */
class OrderCreateResponse implements ResponseInterface
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
     * @JMS\Type("Team3\PayU\Communication\Request\Model\RequestStatus")
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
     * @return OrderCreateResponse
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
     * @return OrderCreateResponse
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
     * @return OrderCreateResponse
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
     * @return OrderCreateResponse
     */
    public function setRequestStatus(RequestStatus $requestStatus)
    {
        $this->requestStatus = $requestStatus;

        return $this;
    }
}
