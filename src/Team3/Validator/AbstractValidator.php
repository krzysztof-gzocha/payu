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

    /**
     * @param ValidationErrorInterface[] $errors
     */
    protected function setValidationErrors(array $errors)
    {
        $this->validationErrors = $errors;
    }

    protected function clearValidationErrors()
    {
        $this->validationErrors = [];
    }

    /**
     * @return bool
     */
    protected function hasNoErrors()
    {
        return 0 === count($this->validationErrors);
    }
}
