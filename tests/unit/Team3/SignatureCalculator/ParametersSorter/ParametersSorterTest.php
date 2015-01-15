<?php
namespace Team3\SignatureCalculator\ParametersSorter;

use JMS\Serializer\SerializerBuilder;
use Psr\Log\LoggerInterface;
use Team3\Order\Model\Order;
use Team3\Order\Model\OrderInterface;
use Team3\Serializer\GroupsSpecifier;
use Team3\Serializer\Serializer;
use Team3\Serializer\SerializerInterface;

/**
 * Class ParametersSorterTest
 * @package Team3\SignatureCalculator\ParametersSorter
 * @group signature
 */
class ParametersSorterTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var OrderInterface
     */
    protected $order;

    protected function _before()
    {
        $this->serializer = new Serializer(
            SerializerBuilder::create()->build(),
            new GroupsSpecifier($this->getLogger()),
            $this->getLogger()
        );

        $this->order = new Order();
        $this->order
            ->setMerchantPosId(123)
            ->setDescription('test')
            ->setContinueUrl('test')
            ->setCustomerIp('127.0.0.1')
            ->setOrderId('123');
    }

    public function testIfParametersAreSorted()
    {
        $parametersSorter = new ParametersSorter($this->serializer);
        $result = $parametersSorter->getSortedParameters($this->order);

        $this->assertInternalType('array', $result);
        $this->assertCount(6, $result, print_r($result, true));
        $lastKey = '';
        foreach ($result as $key => $value) {
            if ('' !== $lastKey) {
                $this->assertLessThan(
                    0,
                    strcmp($lastKey, $key)
                );
            }
            $lastKey = $key;
        }
    }

    /**
     * @return LoggerInterface
     */
    private function getLogger()
    {
        return $this->getMock('Psr\Log\LoggerInterface');
    }
}
