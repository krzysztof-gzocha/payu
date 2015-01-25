<?php
namespace Team3\PayU\Communication\Process\NotificationProcess;


use Psr\Log\LoggerInterface;

class NotificationProcessFactoryTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testResult()
    {
        $factory = new NotificationProcessFactory();

        $this->assertInstanceOf(
            '\Team3\PayU\Communication\Process\NotificationProcess\NotificationProcess',
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
