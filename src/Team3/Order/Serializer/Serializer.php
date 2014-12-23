<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Team3\Order\Model\OrderInterface;
use Team3\Order\Serializer\SerializerInterface as PayUSerializerInterface;

class Serializer implements PayUSerializerInterface
{
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var GroupsSpecifierInterface
     */
    protected $groupsSpecifier;

    /**
     * @param SerializerInterface      $serializer
     * @param GroupsSpecifierInterface $groupsSpecifier
     */
    public function __construct(
        SerializerInterface $serializer,
        GroupsSpecifierInterface $groupsSpecifier
    ) {
        $this->serializer = $serializer;
        $this->groupsSpecifier = $groupsSpecifier;
    }

    /**
     * @param OrderInterface       $order
     * @param SerializationContext $serializationContext
     *
     * @return string
     */
    public function toJson(
        OrderInterface $order,
        SerializationContext $serializationContext = null
    ) {
        if (null == $serializationContext) {
            $serializationContext = new SerializationContext();
        }

        return $this
            ->serializer
            ->serialize(
                $order,
                'json',
                $this->getSerializationContext($order, $serializationContext)
            );
    }

    /**
     * @param string $data
     * @param string $type
     *
     * @return object
     */
    public function fromJson($data, $type)
    {
        return $this
            ->serializer
            ->deserialize(
                $data,
                $type,
                'json'
            );
    }

    /**
     * @param OrderInterface       $order
     * @param SerializationContext $serializationContext
     *
     * @return SerializationContext
     */
    private function getSerializationContext(
        OrderInterface $order,
        SerializationContext $serializationContext
    ) {
        $serializationContext->setGroups(
            $this->groupsSpecifier->specifyGroups($order)
        );

        return $serializationContext;
    }
}
