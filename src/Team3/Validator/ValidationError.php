<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Validator;

class ValidationError implements ValidationErrorInterface
{
    /**
     * @var object
     */
    private $object;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $parameter;

    /**
     * @param object $object
     * @param string $message
     * @param string $parameter
     */
    public function __construct(
        $object,
        $message,
        $parameter
    ) {
        $this->object = $object;
        $this->message = $message;
        $this->parameter = $parameter;
    }

    /**
     * @inheritdoc
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @inheritdoc
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @inheritdoc
     */
    public function getParameter()
    {
        return $this->parameter;
    }
}
