<?php
namespace Team3\PayU\Communication\Process\NotificationProcess;


use Team3\PayU\Communication\Notification\OrderNotification;
use Team3\PayU\Configuration\Credentials\TestCredentials;
use Team3\PayU\Order\Model\OrderStatusInterface;
use Team3\PayU\Serializer\SerializerInterface;
use Team3\PayU\SignatureCalculator\Validator\SignatureValidatorInterface;

class NotificationProcessTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testCompletedStatus()
    {
        $factory = new NotificationProcessFactory();
        $process = $factory->build($this->getMock('\Psr\Log\LoggerInterface'));
        $notification = $process->process(new TestCredentials(), $this->getRealNotification());

        $this->assertTrue(
            $notification->getOrder()->getStatus()->isCompleted()
        );
        $this->assertFalse(
            $notification->getOrder()->getStatus()->isPending()
        );
        $this->assertFalse(
            $notification->getOrder()->getStatus()->isCanceled()
        );
        $this->assertEquals(
            '31.12.2012 12:00:00',
            $notification->getOrder()->getCreatedAt()->format('d.m.Y H:i:s')
        );
    }

    public function testPendingStatus()
    {
        $factory = new NotificationProcessFactory();
        $process = $factory->build($this->getMock('\Psr\Log\LoggerInterface'));
        $notification = $process->process(
            new TestCredentials(),
            $this->getRealNotification(OrderStatusInterface::PENDING)
        );

        $this->assertTrue(
            $notification->getOrder()->getStatus()->isPending()
        );
        $this->assertFalse(
            $notification->getOrder()->getStatus()->isCompleted()
        );
        $this->assertFalse(
            $notification->getOrder()->getStatus()->isCanceled()
        );
        $this->assertEquals(
            '31.12.2012 12:00:00',
            $notification->getOrder()->getCreatedAt()->format('d.m.Y H:i:s')
        );
    }

    public function testResult()
    {
        $process = new NotificationProcess(
            $this->getSerializer(),
            $this->getSignatureValidator(true)
        );

        $result = $process->process(new TestCredentials(), 'data', 'signature');

        $this->assertInstanceOf(
            'Team3\PayU\Communication\Notification\OrderNotification',
            $result
        );
    }

    /**
     * @expectedException \Team3\PayU\Communication\Process\NotificationProcess\NotificationProcessException
     */
    public function testValidationError()
    {
        $process = new NotificationProcess(
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
            ->getMockBuilder('\Team3\PayU\SignatureCalculator\Validator\SignatureValidator')
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
            ->getMockBuilder('\Team3\PayU\Serializer\SerializerInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $serializer
            ->expects($this->any())
            ->method('fromJson')
            ->willReturn(new OrderNotification());

        return $serializer;
    }

    /**
     * @return string notification in json format
     */
    private function getRealNotification($status = 'COMPLETED')
    {
        return sprintf('{
   "order":{
      "orderId":"LDLW5N7MF4140324GUEST000P01",
      "extOrderId":"123456",
      "orderCreateDate":"2012-12-31T12:00:00",
      "notifyUrl":"http://tempuri.org/notify",
      "customerIp":"127.0.0.1",
      "merchantPosId":"123456",
      "description":"Twój opis zamówienia",
      "currencyCode":"PLN",
      "totalAmount":"200",
      "buyer":{
         "email":"john.doe@example.org",
         "phone":"111111111",
         "firstName":"John",
         "lastName":"Doe"
      },
      "products":[
         {
               "name":"Product 1",
               "unitPrice":"200",
               "quantity":"1"
         }
      ],
      "status":"%s"
   }
}', $status);
    }
}
