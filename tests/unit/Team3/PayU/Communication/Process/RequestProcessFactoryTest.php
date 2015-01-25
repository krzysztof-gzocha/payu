<?php
namespace Team3\PayU\Communication\Process;

use Team3\PayU\Communication\Request\OrderCreateRequest;
use Team3\PayU\Configuration\Configuration;
use Team3\PayU\Configuration\Credentials\TestCredentials;
use Team3\PayU\Order\Model\Order;

/**
 * Class RequestProcessFactoryTest
 * @package Team3\PayU\Communication\Process
 * @group logger
 */
class RequestProcessFactoryTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testBuild()
    {
        $logger = $this->getMock('Psr\Log\LoggerInterface');
        $factory = new RequestProcessFactory();

        $this->assertInstanceOf(
            'Team3\PayU\Communication\Process\RequestProcess',
            $factory->build($logger)
        );
    }

    /**
     * @expectedException \Team3\PayU\Communication\Process\InvalidRequestDataObjectException
     */
    public function testValidation()
    {
        $logger = $this->getMock('Psr\Log\LoggerInterface');
        $logger
            ->expects($this->any())
            ->method('debug')
            ->willReturn(null);
        $configuration = new Configuration(new TestCredentials());

        $factory = new RequestProcessFactory();
        $process = $factory->build($logger);
        $process->process(new OrderCreateRequest(new Order()), $configuration);
    }
}
