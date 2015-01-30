<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Notification;

use Team3\PayU\Serializer\SerializableInterface;

/**
 * This class represents every notification that PayU can send to application.
 *
 * Interface NotificationInterface
 * @package Team3\PayU\Communication\Notification
 */
interface NotificationInterface extends SerializableInterface
{
}
