<?php
namespace Team3\Order\Model;

use Doctrine\Common\Annotations\AnnotationReader;
use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\AccessType;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Country;
use Symfony\Component\Validator\Constraints\Currency;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Ip;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Team3\Order\Model\Buyer\Buyer;
use Team3\Order\Model\Money\Money;
use Team3\Order\Model\Products\ProductCollection;
use Team3\Order\Model\ShippingMethods\ShippingMethod;
use Team3\Order\Model\ShippingMethods\ShippingMethodCollection;
use Team3\ValidatorBuilder\ValidatorBuilder;

class OrderTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    protected function _before()
    {
        $this->load();
        $this->validator = (new ValidatorBuilder())->getValidator(new AnnotationReader());
    }

    public function testValidationConfiguration()
    {
        $invalidOrderValidation = $this->validator->validate(new Order());
        $this->assertCount(6, $invalidOrderValidation);

        $validOrder = new Order();
        $validOrder
            ->setCustomerIp('127.0.0.1')
            ->setCurrencyCode('PLN')
            ->setTotalAmount(new Money(10))
            ->setDescription('Test')
            ->setMerchantPosId('123')
            ->setSignature('123');

        $validOrderValidation = $this->validator->validate($validOrder);
        $this->assertCount(0, $validOrderValidation);
    }

    public function testSetters()
    {
        $order = new Order();

        $order->setBuyer(new Buyer());
        $this->assertInstanceOf(
            'Team3\Order\Model\Buyer\BuyerInterface',
            $order->getBuyer()
        );

        $order->setProductCollection(new ProductCollection());
        $this->assertInstanceOf(
            'Team3\Order\Model\Products\ProductCollectionInterface',
            $order->getProductCollection()
        );

        $order->setShippingMethodCollection(new ShippingMethodCollection());
        $this->assertInstanceOf(
            'Team3\Order\Model\ShippingMethods\ShippingMethodCollectionInterface',
            $order->getShippingMethodCollection()
        );

        $order->setStatus(new OrderStatus());
        $this->assertInstanceOf(
            'Team3\Order\Model\OrderStatus',
            $order->getStatus()
        );

        $order->setShippingMethodCollectionFromDeserialization([
            new ShippingMethod(),
            new ShippingMethod(),
        ]);
        $this->assertCount(
            2,
            $order->getShippingMethodCollection()
        );
        $this->assertInstanceOf(
            'Team3\Order\Model\ShippingMethods\ShippingMethodCollection',
            $order->getShippingMethodCollection()
        );
    }

    private function load()
    {
        new Valid();
        new AccessorOrder();
        new AccessType();
        new Type();
        new SerializedName(['value' => 'test']);
        new Ip();
        new NotBlank();
        new Accessor();
        new Currency();
        new \Symfony\Component\Validator\Constraints\Type(['type' => 'integer']);
        new Email();
        new Country();
        new Callback();
    }
}
