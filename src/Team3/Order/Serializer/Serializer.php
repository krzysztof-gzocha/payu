<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface as JMSSerializerInterface;
use Psr\Log\LoggerInterface;
use Team3\Order\Model\OrderInterface;
use Team3\Order\Serializer\SerializerInterface as PayUSerializerInterface;

class Serializer implements PayUSerializerInterface
{
    /**
     * @var JMSSerializerInterface
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
     * @param JMSSerializerInterface   $serializer
     * @param GroupsSpecifierInterface $groupsSpecifier
     * @param LoggerInterface          $logger
     */
    public function __construct(
        JMSSerializerInterface $serializer,
        GroupsSpecifierInterface $groupsSpecifier,
        LoggerInterface $logger
    ) {
        $this->serializer = $serializer;
        $this->groupsSpecifier = $groupsSpecifier;
        $this->logger = $logger;
    }

    /**
     * @param SerializableInterface $serializable
     * @param SerializationContext  $serializationContext
     *
     * @return string
     */
    public function toJson(
        SerializableInterface $serializable,
        SerializationContext $serializationContext = null
    ) {
        if (null == $serializationContext) {
            $serializationContext = new SerializationContext();
        }

        $serializationResult = $this
            ->serializer
            ->serialize(
                $serializable,
                'json',
                $this->getSerializationContext($serializable, $serializationContext)
            );
        $this->logSerializationResult($serializable, $serializationResult);

        return $serializationResult;
    }

    /**
     * @param string $data
     * @param string $type
     *
     * @return array|object
     * @throws SerializerException
     */
    public function fromJson($data, $type)
    {
        try {
            $result = $this
                ->serializer
                ->deserialize(
                    $data,
                    $type,
                    'json'
                );
        } catch (\Exception $exception) {
            $adaptedException = new SerializerException(
                $exception->getMessage(),
                $exception->getCode(),
                $exception
            );
            $this->logException($adaptedException);
            throw $adaptedException;
        }

        return $result;
    }

    /**
     * @param SerializableInterface $serializable
     * @param SerializationContext  $serializationContext
     *
     * @return SerializationContext
     */
    private function getSerializationContext(
        SerializableInterface $serializable,
        SerializationContext $serializationContext
    ) {
        if ($serializable instanceof OrderInterface) {
            $serializationContext->setGroups(
                $this->groupsSpecifier->specifyGroups($serializable)
            );
        }

        return $serializationContext;
    }

    /**
     * @param SerializableInterface $serializable
     * @param string                $result
     */
    private function logSerializationResult(
        SerializableInterface $serializable,
        $result
    ) {
        $this
            ->logger
            ->debug(sprintf(
                'Serializable object %s was serialized to "%s"',
                get_class($serializable),
                $result
            ));
    }

    /**
     * @param \Exception $exception
     */
    private function logException(\Exception $exception)
    {
        $this->logger->error(sprintf(
            '%s exception occurred on deserialization with message "%s"',
            get_class($exception),
            $exception->getMessage()
        ));
    }
}
