<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order\Serializer;

use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\SerializerBuilder;
use Team3\Order\Model\Order;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use Team3\Order\Model\OrderInterface;
use Team3\Order\Model\Products\Product;

/**
 * Class SerializerTest
 * @package Team3\Order\Serializer
 * @group serializer
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
     * @var OrderInterface
     */
    protected $order;

    protected function _before()
    {
        new ExclusionPolicy(['value' => 'all']);
        new VirtualProperty();
        new Type();
        new SerializedName(['value' => 'name']);
        new AccessorOrder();

        $this->serializer = new Serializer(
            SerializerBuilder::create()->build()
        );

        $this->order = $this->getOrder();
    }

    public function testIfResultIsJson()
    {
        $serialized = $this->serializer->toJson($this->order);
        $this->assertNotEmpty($serialized);
        $this->assertJson($serialized);
    }

    public function testIfResultIsFull()
    {
        $serialized = $this->serializer->toJson($this->order);

        $this->assertEquals(
            $this->getJsonResult(),
            $serialized
        );
    }

    /**
     * @return string
     */
    protected function getJsonResult()
    {
        return '{"buyer":{"email":"krzysztof.gzocha@xsolve.pl","firstName":"Krzysztof","lastName":"Gzocha","phone":"123456789"},"continueUrl":"localhost","currencyCode":"PLN","customerIp":"127.0.0.1","description":"Description","extOrderId":"123","merchantPosId":"145227","notifyUrl":"localhost","orderUrl":"localhost","products":[{"name":"Product 1","quantity":"1","unitPrice":"400"},{"name":"Product 2","quantity":"1","unitPrice":"600"}],"OpenPayU-Signature":"signature","totalAmount":1000}';
    }

    /**
     * @return OrderInterface
     */
    protected function getOrder()
    {
        $order = new Order();

        $order
            ->getGeneral()
            ->setCustomerIp('127.0.0.1')
            ->setMerchantPosId('145227')
            ->setDescription('Description')
            ->setCurrencyCode('PLN')
            ->setTotalAmount(1000)
            ->setOrderId(123)
            ->setSignature('signature');

        $order
            ->getUrls()
            ->setNotifyUrl('localhost')
            ->setContinueUrl('localhost')
            ->setOrderUrl('localhost');

        $order
            ->getBuyer()
            ->setFirstName('Krzysztof')
            ->setLastName('Gzocha')
            ->setEmail('krzysztof.gzocha@xsolve.pl')
            ->setPhone('123456789');

        $order
            ->getProductCollection()
            ->addProduct(
                (new Product())
                    ->setName('Product 1')
                    ->setQuantity(1)
                    ->setUnitPrice(400)
            )
            ->addProduct(
                (new Product())
                    ->setName('Product 2')
                    ->setQuantity(1)
                    ->setUnitPrice(600)
            );

        return $order;
    }
}
