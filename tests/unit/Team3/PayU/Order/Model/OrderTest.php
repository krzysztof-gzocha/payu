<?php
namespace Team3\PayU\Order\Model;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Team3\PayU\Order\Model\Buyer\Buyer;
use Team3\PayU\Order\Model\Money\Money;
use Team3\PayU\Order\Model\Products\ProductCollection;
use Team3\PayU\Order\Model\ShippingMethods\ShippingMethod;
use Team3\PayU\Order\Model\ShippingMethods\ShippingMethodCollection;
use Team3\PayU\ValidatorBuilder\ValidatorBuilder;

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
            'Team3\PayU\Order\Model\Buyer\BuyerInterface',
            $order->getBuyer()
        );

        $order->setProductCollection(new ProductCollection());
        $this->assertInstanceOf(
            'Team3\PayU\Order\Model\Products\ProductCollectionInterface',
            $order->getProductCollection()
        );

        $order->setShippingMethodCollection(new ShippingMethodCollection());
        $this->assertInstanceOf(
            'Team3\PayU\Order\Model\ShippingMethods\ShippingMethodCollectionInterface',
            $order->getShippingMethodCollection()
        );

        $order->setStatus(new OrderStatus());
        $this->assertInstanceOf(
            'Team3\PayU\Order\Model\OrderStatus',
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
            'Team3\PayU\Order\Model\ShippingMethods\ShippingMethodCollection',
            $order->getShippingMethodCollection()
        );
    }
}
