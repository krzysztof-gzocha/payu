<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order\Serializer;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\AccessType;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Country;
use Symfony\Component\Validator\Constraints\Currency;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Ip;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Team3\Order\Model\Order;
use Team3\Order\Model\OrderInterface;
use Team3\Order\Model\OrderStatus;
use tests\unit\Team3\Order\Serializer\OrderHelper;

/**
 * Class SerializerTest
 * @package Team3\Order\Serializer
 * @group serializer
 * @group money
 */
class SerializerTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * @var SerializationContext
     */
    protected $serializationContext;

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

        $this->serializationContext = SerializationContext::create();

        $this->order = OrderHelper::getOrderWithDeliveryAndInvoice();
    }

    public function testIfResultIsJson()
    {
        $serialized = $this->serializer->toJson($this->order, $this->serializationContext);
        $this->assertNotEmpty($serialized);
        $this->assertJson($serialized);
    }

    public function testIfResultIsFull()
    {
        $serialized = $this->serializer->toJson($this->order);

        $this->assertEquals(
            OrderHelper::getOrderWithDeliveryAndInvoiceAsJson(),
            $serialized
        );
    }

    public function testResultWithoutDeliveryAndInvoice()
    {
        $serialized = $this->serializer->toJson(
            OrderHelper::getOrderWithoutDeliveryAndInvoice(),
            $this->serializationContext
        );

        $this->assertEquals(
            OrderHelper::getOrderAsJson(),
            $serialized
        );
    }

    public function testDeserialization()
    {
        $serializedString = '{
    "orderId": "{orderId}",
    "extOrderId": "358766",
    "orderCreateDate": "2014-10-27T14:58:17.443+01:00",
    "notifyUrl": "http://localhost/OrderNotify/",
    "customerIp": "127.0.0.1",
    "merchantPosId": "145227",
    "description": "New order",
    "currencyCode": "PLN",
    "totalAmount": "3200",
    "shippingMethods": [
        {
            "country": "PL",
            "name": "Some method",
            "price": "120"
        }
    ],
    "status": "NEW",
    "products": [
        {
            "name": "Product1",
            "unitPrice": "1000",
            "quantity": "1"
        },
        {
            "name": "Product2",
            "unitPrice": "2200",
            "quantity": "1"
        }
    ]
}';
        /** @var OrderInterface $deserializedObject */
        $deserializedObject = $this->serializer->fromJson($serializedString, 'Team3\Order\Model\Order');

        $this->assertEquals(
            $deserializedObject->getOrderId(),
            '358766'
        );

        $this->assertEquals(
            $deserializedObject->getNotifyUrl(),
            'http://localhost/OrderNotify/'
        );

        $this->assertEquals(
            $deserializedObject->getTotalAmount()->getValue(),
            32
        );

        $this->assertCount(
            2,
            $deserializedObject->getProductCollection()
        );

        $this->assertEquals(
            OrderStatus::NEW_ORDER,
            $deserializedObject->getStatus()->getValue()
        );

        $this->assertTrue(
            $deserializedObject->getStatus()->isNew()
        );
    }

    /**
     * @return \Psr\Log\LoggerInterface
     */
    private function getLogger()
    {
        return $this->getMock('Psr\Log\LoggerInterface');
    }

    private function load()
    {
        new Type();
        new SerializedName(['value' => 'name']);
        new AccessorOrder();
        new AccessType();
        new Accessor();
        new Ip();
        new NotBlank();
        new Currency();
        new \Symfony\Component\Validator\Constraints\Type(["type" => "integer"]);
        new Email();
        new Country();
        new GreaterThan();
        new NotNull();
        new Callback();
    }
}
