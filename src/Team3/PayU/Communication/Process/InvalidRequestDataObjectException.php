<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Process;

use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * This exception will be thrown when {@link PayURequestInterface}
 * requires an object, but this object is invalid.
 * To get violations please use {@method getViolations}
 *
 * Class InvalidRequestDataObjectException
 * @package Team3\PayU\Communication\Process
 */
class InvalidRequestDataObjectException extends RequestProcessException
{
    /**
     * @var ConstraintViolationListInterface
     */
    private $violations;

    /**
     * @param ConstraintViolationListInterface $violations
     * @param string                           $message
     */
    public function __construct(
        ConstraintViolationListInterface $violations,
        $message = ""
    ) {
        parent::__construct($message);
        $this->violations = $violations;
    }

    /**
     * @return ConstraintViolationListInterface
     */
    public function getViolations()
    {
        return $this->violations;
    }
}
