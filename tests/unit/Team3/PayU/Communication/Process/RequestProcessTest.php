<?php
namespace Team3\PayU\Communication\Process;

use Buzz\Message\MessageInterface;
use Buzz\Message\Response;
use JMS\Serializer\SerializerBuilder;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Team3\PayU\Communication\ClientInterface;
use Team3\PayU\Communication\HttpStatusParser\HttpStatusParserInterface;
use Team3\PayU\Communication\Process\ResponseDeserializer\NoResponseFoundException;
use Team3\PayU\Communication\Process\ResponseDeserializer\ResponseDeserializer;
use Team3\PayU\Communication\Request\OrderCreateRequest;
use Team3\PayU\Communication\Request\OrderRetrieveRequest;
use Team3\PayU\Communication\Request\PayURequestInterface;
use Team3\PayU\Communication\Response\OrderCreateResponse;
use Team3\PayU\Communication\Response\OrderRetrieveResponse;
use Team3\PayU\Configuration\Configuration;
use Team3\PayU\Configuration\ConfigurationInterface;
use Team3\PayU\Configuration\Credentials\TestCredentials;
use Team3\PayU\Order\Model\Order;
use Team3\PayU\Serializer\GroupsSpecifier;
use Team3\PayU\Serializer\Serializer;
use Team3\PayU\Serializer\SerializerException;
use Team3\PayU\Serializer\SerializerInterface;

/**
 * Class RequestProcessTest
 * @package Team3\PayU\Communication\RequestProcess
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
     * There is no response object, so NoResponseFoundException can be thrown
     * as long as there is no InvalidRequestDataObjectException
     *
     * @throws \Team3\PayU\Communication\Process\ResponseDeserializer\NoResponseFoundException
     * @expectedException \Team3\PayU\Communication\Process\ResponseDeserializer\NoResponseFoundException
     */
    public function testDisabledValidation()
    {
        $requestProcess = new RequestProcess(
            $this->getResponseDeserializer(),
            $this->getClient($this->getCreateOrderCurlResponse()),
            $this->getValidator(1),
            $this->getHttpStatusParser()
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
            '\Team3\PayU\Communication\Response\OrderCreateResponse',
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

    public function testOrderRetrieveRequestProcess()
    {
        /** @var OrderRetrieveResponse $response */
        $response = $this
            ->getRequestProcess($this->getOrderStatusCurlResponse())
            ->process(
                new OrderRetrieveRequest(new Order()),
                $this->configuration
            );

        $this->assertInstanceOf(
            'Team3\PayU\Communication\Response\OrderRetrieveResponse',
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
        $this->assertEquals(
            '27.10.2014 14:58:17',
            $response->getFirstOrder()->getCreatedAt()->format('d.m.Y H:i:s')
        );
    }

    /**
     * @expectedException \Team3\PayU\Communication\Process\RequestProcessException
     */
    public function testSerializerException()
    {
        $message = new Response();
        $message->setContent('123');
        $response = $this
            ->getMockBuilder('\Team3\PayU\Communication\Response\ResponseInterface')
            ->getMock();
        $response
            ->expects($this->any())
            ->method('supports')
            ->withAnyParameters()
            ->willReturn(true);

        $client = $this->getMock('\Team3\PayU\Communication\ClientInterface');
        $client
            ->expects($this->any())
            ->method('sendRequest')
            ->withAnyParameters()
            ->willReturn($message);
        $serializer = $this
            ->getMockBuilder('\Team3\PayU\Serializer\SerializerInterface')
            ->getMock();
        $serializer
            ->expects($this->any())
            ->method('fromJson')
            ->withAnyParameters()
            ->willThrowException(new SerializerException());

        $requestProcess = new RequestProcess(
            $this->getResponseDeserializer(),
            $client,
            $this->getValidator(),
            $this->getHttpStatusParser()
        );
        $requestProcess->addResponse($response);

        $requestProcess->process(
            $this->getPayURequest(),
            $this->configuration
        );
    }

    /**
     * @return HttpStatusParserInterface
     */
    private function getHttpStatusParser()
    {
        return $this
            ->getMock('\Team3\PayU\Communication\HttpStatusParser\HttpStatusParserInterface');
    }

    /**
     * @return PayURequestInterface
     */
    private function getPayURequest()
    {
        $request = $this->getMock('\Team3\PayU\Communication\Request\PayURequestInterface');
        $request
            ->expects($this->any())
            ->method('getDataObject')
            ->willReturn(
                $this->getMock('\Team3\PayU\Serializer\SerializableInterface')
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
            $this->getValidator(),
            $this->getHttpStatusParser()
        );

        $requestProcess
            ->addResponse(new OrderRetrieveResponse())
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
            ->getMockBuilder('Team3\PayU\Communication\ClientInterface')
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
