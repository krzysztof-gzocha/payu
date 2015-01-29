<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Process;

use Team3\PayU\PayUException;

/**
 * This exception will be thrown when {@link RequestProcessInterface} will fail.
 *
 * Class RequestProcessException
 * @package Team3\PayU\Communication\Process
 */
class RequestProcessException extends PayUException
{
}
