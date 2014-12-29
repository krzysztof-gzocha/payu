<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Psr\Log\LoggerInterface;
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
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param SerializerInterface      $serializer
     * @param GroupsSpecifierInterface $groupsSpecifier
     * @param LoggerInterface          $logger
     */
    public function __construct(
        SerializerInterface $serializer,
        GroupsSpecifierInterface $groupsSpecifier,
        LoggerInterface $logger
    ) {
        $this->serializer = $serializer;
        $this->groupsSpecifier = $groupsSpecifier;
        $this->logger = $logger;
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

        $serializationResult = $this
            ->serializer
            ->serialize(
                $order,
                'json',
                $this->getSerializationContext($order, $serializationContext)
            );
        $this->logSerializationResult($order, $serializationResult);

        return $serializationResult;
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

    /**
     * @param OrderInterface $order
     * @param string         $result
     */
    private function logSerializationResult(
        OrderInterface $order,
        $result
    ) {
        $this
            ->logger
            ->debug(sprintf(
                'Order with id %s was serialized to "%s"',
                $order->getOrderId(),
                $result
            ));
    }
}
