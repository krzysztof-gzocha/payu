<?php
namespace Team3\Communication\Process;

use Buzz\Message\MessageInterface;
use Buzz\Message\Response;
use JMS\Serializer\SerializerBuilder;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Team3\Communication\ClientInterface;
use Team3\Communication\Process\ResponseDeserializer\NoResponseObjectException;
use Team3\Communication\Process\ResponseDeserializer\ResponseDeserializer;
use Team3\Communication\Request\OrderCreateRequest;
use Team3\Communication\Request\OrderStatusRequest;
use Team3\Communication\Request\PayURequestInterface;
use Team3\Communication\Response\OrderCreateResponse;
use Team3\Communication\Response\OrderStatusResponse;
use Team3\Configuration\Configuration;
use Team3\Configuration\ConfigurationInterface;
use Team3\Configuration\Credentials\TestCredentials;
use Team3\Order\Model\Order;
use Team3\Order\Serializer\GroupsSpecifier;
use Team3\Order\Serializer\Serializer;
use Team3\Order\Serializer\SerializerException;
use Team3\Order\Serializer\SerializerInterface;

/**
 * Class RequestProcessTest
 * @package Team3\Communication\RequestProcess
 * @group communication
 */
class RequestProcessTest extends \Codeception\TestCase\Test
{
    const ORDER_ID = 'WZHF5FFDRJ140731GUEST000P01';
    const EXT_ORDER_ID = '123';
    const REDIRECT_URI = 'http://localhost';
    const ORDER_STATUS = 'NEW';

    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var ConfigurationInterface
     */
    protected $configuration;

    protected function _before()
    {
        $this->serializer = new Serializer(
            SerializerBuilder::create()->build(),
            new GroupsSpecifier($this->getLogger()),
            $this->getLogger()
        );

        $this->configuration = new Configuration(new TestCredentials());
    }

    /**
     * There is no response object, so NoResponseObjectException can be thrown
     * as long as there is no InvalidRequestDataObjectException
     *
     * @expectedException \Team3\Communication\Process\ResponseDeserializer\NoResponseObjectException
     */
    public function testDisabledValidation()
    {
        $requestProcess = new RequestProcess(
            $this->getResponseDeserializer(),
            $this->getClient($this->getCreateOrderCurlResponse()),
            $this->getValidator(1)
        );
        $requestProcess->disableValidation();
        $requestProcess->process($this->getPayURequest(), $this->configuration);
    }

    public function testCreateOrderRequestProcess()
    {
        $response = $this
            ->getRequestProcess($this->getCreateOrderCurlResponse())
            ->process(
                new OrderCreateRequest(new Order()),
                $this->configuration
            );

        $this->assertInstanceOf(
            '\Team3\Communication\Response\OrderCreateResponse',
            $response
        );
        $this->assertEquals(
            self::ORDER_ID,
            $response->getOrderId()
        );
        $this->assertEquals(
            self::EXT_ORDER_ID,
            $response->getExtOrderId()
        );
        $this->assertEquals(
            self::REDIRECT_URI,
            $response->getRedirectUri()
        );

        $this->assertTrue(
            $response->getRequestStatus()->isSuccess()
        );
    }

    public function testOrderStatusRequestProcess()
    {
        /** @var OrderStatusResponse $response */
        $response = $this
            ->getRequestProcess($this->getOrderStatusCurlResponse())
            ->process(
                new OrderStatusRequest(new Order()),
                $this->configuration
            );

        $this->assertInstanceOf(
            'Team3\Communication\Response\OrderStatusResponse',
            $response
        );
        $this->assertEquals(
            self::ORDER_ID,
            $response->getFirstOrder()->getPayUOrderId()
        );
        $this->assertEquals(
            self::EXT_ORDER_ID,
            $response->getFirstOrder()->getOrderId()
        );
        $this->assertTrue(
            $response->getRequestStatus()->isSuccess()
        );
        $this->assertTrue(
            $response->getFirstOrder()->getStatus()->isNew()
        );
    }

    /**
     * @expectedException \Team3\Communication\Process\RequestProcessException
     */
    public function testSerializerException()
    {
        $message = new Response();
        $message->setContent('123');
        $response = $this
            ->getMockBuilder('\Team3\Communication\Response\ResponseInterface')
            ->getMock();
        $response
            ->expects($this->any())
            ->method('supports')
            ->withAnyParameters()
            ->willReturn(true);

        $client = $this->getMock('\Team3\Communication\ClientInterface');
        $client
            ->expects($this->any())
            ->method('sendRequest')
            ->withAnyParameters()
            ->willReturn($message);
        $serializer = $this
            ->getMockBuilder('\Team3\Order\Serializer\SerializerInterface')
            ->getMock();
        $serializer
            ->expects($this->any())
            ->method('fromJson')
            ->withAnyParameters()
            ->willThrowException(new SerializerException());

        $requestProcess = new RequestProcess(
            $this->getResponseDeserializer(),
            $client,
            $this->getValidator()
        );
        $requestProcess->addResponse($response);

        $requestProcess->process(
            $this->getPayURequest(),
            $this->configuration
        );
    }

    /**
     * @return PayURequestInterface
     */
    private function getPayURequest()
    {
        $request = $this->getMock('\Team3\Communication\Request\PayURequestInterface');
        $request
            ->expects($this->any())
            ->method('getDataObject')
            ->willReturn(
                $this->getMock('\Team3\Order\Serializer\SerializableInterface')
            );

        return $request;
    }

    /**
     * @param Response $curlResponse
     *
     * @return RequestProcess
     */
    private function getRequestProcess(Response $curlResponse)
    {
        $requestProcess = new RequestProcess(
            $this->getResponseDeserializer(),
            $this->getClient($curlResponse),
            $this->getValidator()
        );

        $requestProcess
            ->addResponse(new OrderStatusResponse())
            ->addResponse(new OrderCreateResponse());

        return $requestProcess;
    }

    /**
     * @param MessageInterface $message
     *
     * @return ClientInterface
     */
    private function getClient(MessageInterface $message)
    {
        $client = $this
            ->getMockBuilder('Team3\Communication\ClientInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $client
            ->expects($this->any())
            ->method('sendRequest')
            ->withAnyParameters()
            ->willReturn($message);

        return $client;
    }

    /**
     * @return LoggerInterface
     */
    private function getLogger()
    {
        return $this
            ->getMockBuilder('Psr\Log\LoggerInterface')
            ->getMock();
    }

    /**
     * @return ResponseDeserializer
     */
    private function getResponseDeserializer()
    {
        return new ResponseDeserializer($this->serializer);
    }

    /**
     * @param int $violationsCount
     *
     * @return ValidatorInterface
     */
    private function getValidator($violationsCount = 0)
    {
        $validator = $this
            ->getMockBuilder('\Symfony\Component\Validator\Validator\ValidatorInterface')
            ->getMock();

        $violations = $this
            ->getMockBuilder('\Symfony\Component\Validator\ConstraintViolationListInterface')
            ->getMock();

        $violations
            ->expects($this->any())
            ->method('count')
            ->willReturn($violationsCount);

        $validator
            ->expects($this->any())
            ->method('validate')
            ->withAnyParameters()
            ->willReturn($violations);

        return $validator;
    }

    /**
     * @return Response
     */
    private function getCreateOrderCurlResponse()
    {
        $response = new Response();
        $response->setContent(sprintf('{
   "status":{
      "statusCode":"SUCCESS"
   },
   "redirectUri":"%s",
   "orderId":"%s",
   "extOrderId":"%s"
}',
            self::REDIRECT_URI,
            self::ORDER_ID,
            self::EXT_ORDER_ID
        ));

        return $response;
    }

    /**
     * @return Response
     */
    private function getOrderStatusCurlResponse()
    {
        $response = new Response();
        $response->setContent('{
        "orders": [
            {
                "orderId": "'.self::ORDER_ID.'",
                "extOrderId": "'.self::EXT_ORDER_ID.'",
                "orderCreateDate": "2014-10-27T14:58:17.443+01:00",
                "notifyUrl": "http://localhost/OrderNotify/",
                "customerIp": "127.0.0.1",
                "merchantPosId": "145227",
                "description": "New order",
                "currencyCode": "PLN",
                "totalAmount": "3200",
                "status": "'.self::ORDER_STATUS.'",
                "products": [
                    {
                        "name": "Product1",
                        "unitPrice": "1000",
                        "quantity": "1"
                    },
                    {
                        "name": "Product2",
                        "unitPrice": "2200",
                        "quantity": "1"
                    }
                ]
            }
        ],
        "status": {
            "statusCode": "SUCCESS",
            "statusDesc": "Request processing successful"
        }
}');

        return $response;
    }
}
