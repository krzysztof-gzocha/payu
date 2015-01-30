<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Process\NotificationProcess;

use Team3\PayU\PayUException;

/**
 * This exception when unpredicted behaviour in notification process will occur.
 *
 * Class NotificationProcessException
 * @package Team3\PayU\Communication\Process\NotificationProcess
 */
class NotificationProcessException extends PayUException
{
}
