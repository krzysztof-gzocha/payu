<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Validator;

abstract class AbstractValidator implements ValidatorInterface
{
    /**
     * @var ValidationErrorInterface[]
     */
    private $validationErrors;

    public function __construct()
    {
        $this->validationErrors = [];
    }

    /**
     * @inheritdoc
     */
    public function getValidationErrors()
    {
        return $this->validationErrors;
    }

    /**
     * @param object $object
     * @param string $message
     * @param string $parameterName
     */
    protected function addValidationError(
        $object,
        $message,
        $parameterName
    ) {
        $this->validationErrors[] = new ValidationError($object, $message, $parameterName);
    }
}
