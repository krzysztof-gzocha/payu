<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Model\Buyer;

use JMS\Serializer\Annotation as JMS;
use Team3\Order\Model\Traits\AddressTrait;

/**
 * Class Delivery
 * @package Team3\Order\Model\Buyer
 * @JMS\AccessorOrder("alphabetical")
 */
class Delivery implements DeliveryInterface
{
    use AddressTrait;
}
