<?php
namespace Team3\PayU\SignatureCalculator\ParametersSorter;

use JMS\Serializer\SerializerBuilder;
use Psr\Log\LoggerInterface;
use Team3\PayU\Order\Model\Order;
use Team3\PayU\Order\Model\OrderInterface;
use Team3\PayU\Serializer\GroupsSpecifier;
use Team3\PayU\Serializer\Serializer;
use Team3\PayU\Serializer\SerializerInterface;

/**
 * Class ParametersSorterTest
 * @package Team3\PayU\SignatureCalculator\ParametersSorter
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
