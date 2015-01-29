<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\ValidatorBuilder;

use Doctrine\Common\Annotations\Reader;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Will build {@link ValidationInterface}
 *
 * Interface ValidatorBuilderInterface
 * @package Team3\PayU\ValidatorBuilder
 */
interface ValidatorBuilderInterface
{
    /**
     * @param Reader $reader
     *
     * @return ValidatorInterface
     */
    public function getValidator(Reader $reader = null);
}
