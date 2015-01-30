<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Serializer;

use Team3\PayU\Order\Model\OrderInterface;

/**
 * This class can specify serialization groups used to serialize {@link OrderInterface}
 *
 * Interface GroupsSpecifierInterface
 * @package Team3\PayU\Serializer
 */
interface GroupsSpecifierInterface
{
    /**
     * @param OrderInterface $order
     *
     * @return array
     */
    public function specifyGroups(OrderInterface $order);
}
