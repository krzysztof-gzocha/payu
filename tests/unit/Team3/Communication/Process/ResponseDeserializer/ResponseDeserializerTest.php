<?php
namespace Team3\Communication\Process\ResponseDeserializer;

use Buzz\Message\MessageInterface;
use Team3\Communication\Request\PayURequestInterface;
use Team3\Communication\Response\EmptyResponse;
use Team3\Communication\Response\ResponseInterface;
use Team3\Serializer\SerializerInterface;

/**
 * Class ResponseDeserializerTest
 * @package Team3\Communication\Process\ResponseDeserializer
 * @group communication
 */
class ResponseDeserializerTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @expectedException \Team3\Communication\Process\ResponseDeserializer\NoResponseFoundException
     */
    public function testException()
    {
        $responseDeserializer = new ResponseDeserializer($this->getSerializer());
        $responseDeserializer->deserializeResponse(
            $this->getCurlResponse(),
            $this->getPayURequest()
        );
    }

    public function testResponseClass()
    {
        $responseDeserializer = new ResponseDeserializer($this->getSerializer());
        $responseDeserializer->addResponse($this->getResponse());
        $response = $responseDeserializer->deserializeResponse(
            $this->getCurlResponse(),
            $this->getPayURequest()
        );

        $this->assertInstanceOf(
            'Team3\Communication\Response\ResponseInterface',
            $response
        );
    }

    /**
     * @return PayURequestInterface
     */
    private function getPayURequest()
    {
        return $this
            ->getMock('\Team3\Communication\Request\PayURequestInterface');
    }

    /**
     * @return MessageInterface
     */
    private function getCurlResponse()
    {
        return $this
            ->getMock('\Buzz\Message\MessageInterface');
    }

    /**
     * @return SerializerInterface
     */
    private function getSerializer()
    {
        $serializer = $this->getMock('Team3\Serializer\SerializerInterface');
        $serializer
            ->expects($this->any())
            ->method('fromJson')
            ->withAnyParameters()
            ->willReturn($this->getResponse());

        return $serializer;
    }

    /**
     * @return ResponseInterface
     */
    private function getResponse()
    {
        $response = $this
            ->getMock('Team3\Communication\Response\ResponseInterface');
        $response
            ->expects($this->any())
            ->method('supports')
            ->withAnyParameters()
            ->willReturn(true);

        return $response;
    }
}
