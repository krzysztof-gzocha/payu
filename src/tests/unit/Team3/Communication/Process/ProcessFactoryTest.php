<?php
namespace Team3\Communication\Process;

use Team3\Communication\Request\OrderCreateRequest;
use Team3\Configuration\Configuration;
use Team3\Configuration\Credentials\TestCredentials;
use Team3\Order\Model\Order;
use Team3\Order\Model\Products\Product;
use Team3\Order\Model\Money\Money;

/**
 * Class ProcessFactoryTest
 * @package Team3\Communication\Process
 * @group logger
 * @group realExample
 */
class ProcessFactoryTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testBuild()
    {
        $logger = $this->getMock('Psr\Log\LoggerInterface');
        $factory = new ProcessFactory();

        $this->assertInstanceOf(
            'Team3\Communication\Process\RequestProcess',
            $factory->build($logger)
        );
    }

    /**
     * @expectedException \Team3\Communication\Process\InvalidRequestDataObjectException
     */
    public function testValidation()
    {
        $logger = $this->getMock('Psr\Log\LoggerInterface');
        $logger
            ->expects($this->any())
            ->method('debug')
            ->willReturn(null);
        $configuration = new Configuration(new TestCredentials());

        $factory = new ProcessFactory();
        $process = $factory->build($logger);
        $process->process(new OrderCreateRequest(new Order()), $configuration);
    }

    /**
     * @return Order
     */
    private function getOrder()
    {
        $order = new Order();
        $order
            ->getProductCollection()
            ->addProduct(
                (new Product())
                    ->setName('Produkt 1')
                    ->setQuantity(1)
                    ->setUnitPrice(new Money(10))
            );
        $order
            ->setDescription('Order')
            ->setTotalAmount(new Money(10))
            ->setMerchantPosId(TestCredentials::MERCHANT_POS_ID);

        return $order;
    }
}
