<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Order\Model\Buyer;

use JMS\Serializer\Annotation as JMS;
use Team3\PayU\Order\Model\Traits\AddressTrait;

/**
 * Class Delivery
 * @package Team3\PayU\Order\Model\Buyer
 * @JMS\AccessorOrder("alphabetical")
 */
class Delivery implements DeliveryInterface
{
    use AddressTrait;
}
