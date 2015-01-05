<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Serializer;

use Team3\Order\Model\OrderInterface;

interface GroupsSpecifierInterface
{
    /**
     * @param OrderInterface $order
     *
     * @return array
     */
    public function specifyGroups(OrderInterface $order);
}
