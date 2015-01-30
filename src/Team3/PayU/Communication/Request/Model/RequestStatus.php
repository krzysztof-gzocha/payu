<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Request\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * This class is representing status of the given request to PayU.
 *
 * Class RequestStatus
 * @package Team3\PayU\Communication\Request\Model
 */
class RequestStatus
{
    const STATUS_SUCCESS = 'SUCCESS';

    /**
     * @var string
     * @JMS\SerializedName("statusCode")
     * @JMS\Type("string")
     */
    private $code;

    /**
     * @var string
     * @JMS\SerializedName("statusDesc")
     * @JMS\Type("string")
     */
    private $description;

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return RequestStatus
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return RequestStatus
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return self::STATUS_SUCCESS === $this->code;
    }

    /**
     * @return bool
     */
    public function isError()
    {
        return self::STATUS_SUCCESS !== $this->code;
    }
}
