<?php
namespace Team3\SignatureCalculator;

use JMS\Serializer\SerializerBuilder;
use Team3\Configuration\Credentials\Credentials;
use Team3\Configuration\Credentials\TestCredentials;
use Team3\Order\Model\Money\Money;
use Team3\Order\Model\Order;
use Team3\Order\Model\Products\Product;
use Team3\Order\Serializer\GroupsSpecifier;
use Team3\Order\Serializer\Serializer;
use Team3\SignatureCalculator\Encoder\Algorithms\Md5Algorithm;
use Team3\SignatureCalculator\Encoder\Encoder;
use Team3\SignatureCalculator\Encoder\EncoderException;
use Team3\SignatureCalculator\Encoder\Strategy\Md5Strategy;
use Team3\SignatureCalculator\ParametersSorter\ParametersSorter;
use Team3\SignatureCalculator\ParametersSorter\ParametersSorterInterface;

/**
 * Class SignatureCalculatorTest
 * @package Team3\SignatureCalculator
 * @group signature
 */
class SignatureCalculatorTest extends \Codeception\TestCase\Test
{
    const ENCODED_STRING = 'encodedString';
    const ALGORITHM = 'algorithm';
    const MERCHANT_POS_ID = '123';
    const EXCEPTION_MESSAGE = 'Exception message';

    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var ParametersSorterInterface
     */
    protected $parametersSorter;

    /**
     * @var SignatureCalculatorInterface
     */
    protected $signatureCalculator;

    protected function _before()
    {
        $this->parametersSorter = $this
            ->getMockBuilder('Team3\SignatureCalculator\ParametersSorter\ParametersSorter')
            ->disableOriginalConstructor()
            ->getMock();

        $this->parametersSorter
            ->expects($this->any())
            ->method('getSortedParameters')
            ->withAnyParameters()
            ->willReturn([
                'a' => 1,
                'b' => 2,
                'c' => 3,
            ]);

        $encoder = $this
            ->getMockBuilder('Team3\SignatureCalculator\Encoder\Encoder')
            ->disableOriginalConstructor()
            ->getMock();

        $encoder
            ->expects($this->any())
            ->method('encode')
            ->withAnyParameters()
            ->willReturn(self::ENCODED_STRING);

        $this->signatureCalculator = new SignatureCalculator(
            $this->parametersSorter,
            $encoder
        );
    }

    public function testSignature()
    {
        $credentials = new Credentials(self::MERCHANT_POS_ID, '456');
        $order = new Order();
        $algorithm = $this
            ->getMockBuilder('Team3\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface')
            ->getMock();
        $algorithm
            ->expects($this->any())
            ->method('getName')
            ->willReturn(self::ALGORITHM);

        $signature = $this->signatureCalculator->calculate($order, $credentials, $algorithm);
        $this->assertEquals(
            sprintf(
                SignatureCalculator::SIGNATURE_FORMAT,
                self::ENCODED_STRING,
                self::ALGORITHM,
                self::MERCHANT_POS_ID
            ),
            $signature
        );
    }

    /**
     * @expectedException \Team3\SignatureCalculator\SignatureCalculatorException
     * @expectedExceptionMessage Exception message
     */
    public function testSignatureCalculatorException()
    {
        $credentials = new TestCredentials();
        $order = new Order();

        $algorithm = $this
            ->getMockBuilder('\Team3\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface')
            ->getMock();

        $encoder = $this
            ->getMockBuilder('\Team3\SignatureCalculator\Encoder\Encoder')
            ->disableOriginalConstructor()
            ->getMock();
        $encoder
            ->expects($this->any())
            ->method('encode')
            ->withAnyParameters()
            ->willThrowException(new EncoderException(self::EXCEPTION_MESSAGE));

        $signatureCalculator = new SignatureCalculator(
            $this->parametersSorter,
            $encoder
        );

        $signatureCalculator->calculate($order, $credentials, $algorithm);
    }

    public function testRealExample()
    {
        $credentials = new TestCredentials();
        $order = $this->getOrder();
        $algorithm = new Md5Algorithm();
        $encoder = new Encoder();
        $encoder->addStrategy(new Md5Strategy());
        $signatureCalculator = new SignatureCalculator(
            $this->getParametersSorter(),
            $encoder
        );

        $this->assertEquals(
            'signature=0fcbdfd920b218edd56366966bef2dcc;algorithm=MD5;sender=145227',
            $signatureCalculator->calculate($order, $credentials, $algorithm)
        );
    }

    /**
     * @return ParametersSorter
     */
    private function getParametersSorter()
    {
        $parametersSorter = new ParametersSorter(
            new Serializer(
                SerializerBuilder::create()->build(),
                new GroupsSpecifier()
            )
        );

        return $parametersSorter;
    }

    /**
     * @return Order
     */
    private function getOrder()
    {
        $order = new Order();
        $order->setCustomerIp('123.123.123.123');
        $order->setMerchantPosId('145227');
        $order->setDescription('Order description');
        $order->setTotalAmount(new Money(10));
        $order->setCurrencyCode('PLN');
        $order->setContinueUrl('http://localhost/continue');
        $order->setNotifyUrl('http://shop.url/notify.json');
        $order
            ->getProductCollection()
            ->addProduct(
                (new Product())
                    ->setName('Product 1')
                    ->setUnitPrice(new Money(10))
                    ->setQuantity(1)
            );

        return $order;
    }
}
