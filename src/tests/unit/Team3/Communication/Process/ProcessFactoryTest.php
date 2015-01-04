<?php
namespace Team3\Communication\Process;

use Team3\Communication\Request\OrderCreateRequest;
use Team3\Configuration\Configuration;
use Team3\Configuration\Credentials\TestCredentials;
use Team3\Order\Model\Order;

/**
 * Class ProcessFactoryTest
 * @package Team3\Communication\Process
 * @group logger
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
}
