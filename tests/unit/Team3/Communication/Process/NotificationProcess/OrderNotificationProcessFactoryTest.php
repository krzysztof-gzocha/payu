<?php
namespace Team3\Communication\Process\NotificationProcess;


use Psr\Log\LoggerInterface;

class OrderNotificationProcessFactoryTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testResult()
    {
        $factory = new OrderNotificationProcessFactory();

        $this->assertInstanceOf(
            '\Team3\Communication\Process\NotificationProcess\OrderNotificationProcess',
            $factory->build($this->getLogger())
        );
    }

    /**
     * @return LoggerInterface
     */
    private function getLogger()
    {
        return $this->getMock('Psr\Log\LoggerInterface');
    }
}
