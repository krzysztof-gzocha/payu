<?php
namespace Team3\SignatureCalculator\ParametersSorter;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\AccessType;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\SerializerBuilder;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Country;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Ip;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Valid;
use Team3\Order\Model\Order;
use Team3\Order\Model\OrderInterface;
use Team3\Order\Serializer\GroupsSpecifier;
use Team3\Order\Serializer\Serializer;
use Team3\Order\Serializer\SerializerInterface;

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
        $this->load();
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

    private function load()
    {
        new AccessorOrder();
        new AccessType();
        new Type();
        new Accessor();
        new Groups();

        new Valid();
        new SerializedName(['value' => 't']);
        new Ip();
        new NotBlank();
        new \Symfony\Component\Validator\Constraints\Type(['type' => 'test']);
        new Callback();
        new Email();
        new Country();
    }
}
