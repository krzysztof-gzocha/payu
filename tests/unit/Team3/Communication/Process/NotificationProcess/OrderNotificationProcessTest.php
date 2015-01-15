<?php
namespace Team3\Communication\Process\NotificationProcess;


use Team3\Communication\Notification\OrderNotification;
use Team3\Configuration\Credentials\TestCredentials;
use Team3\Serializer\SerializerInterface;
use Team3\SignatureCalculator\Validator\SignatureValidatorInterface;

class OrderNotificationProcessTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testResult()
    {
        $process = new OrderNotificationProcess(
            $this->getSerializer(),
            $this->getSignatureValidator(true)
        );

        $result = $process->process(new TestCredentials(), 'data', 'signature');

        $this->assertInstanceOf(
            'Team3\Communication\Notification\OrderNotification',
            $result
        );
    }

    /**
     * @expectedException \Team3\Communication\Process\NotificationProcess\NotificationProcessException
     */
    public function testValidationError()
    {
        $process = new OrderNotificationProcess(
            $this->getSerializer(),
            $this->getSignatureValidator(false)
        );

        $process->process(new TestCredentials(), 'data', 'signature');
    }

    /**
     * @param $isValid
     *
     * @return SignatureValidatorInterface
     */
    private function getSignatureValidator($isValid)
    {
        $validator = $this
            ->getMockBuilder('\Team3\SignatureCalculator\Validator\SignatureValidator')
            ->disableOriginalConstructor()
            ->getMock();

        $validator
            ->expects($this->any())
            ->method('isSignatureValid')
            ->willReturn($isValid);

        return $validator;
    }

    /**
     * @return SerializerInterface
     */
    private function getSerializer()
    {
        $serializer = $this
            ->getMockBuilder('\Team3\Serializer\SerializerInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $serializer
            ->expects($this->any())
            ->method('fromJson')
            ->willReturn(new OrderNotification());

        return $serializer;
    }
}
