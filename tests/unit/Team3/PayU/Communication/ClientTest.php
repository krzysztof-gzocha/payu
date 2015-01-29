<?php
namespace Team3\PayU\Communication;

use Buzz\Client\ClientInterface;
use Buzz\Client\Curl;
use Buzz\Exception\RequestException;
use Buzz\Message\Request;
use Buzz\Message\Response;
use Psr\Log\LoggerInterface;
use Team3\PayU\Communication\CurlRequestBuilder\CurlRequestBuilderInterface;
use Team3\PayU\Communication\Sender\SenderInterface;
use Team3\PayU\Configuration\Configuration;
use Team3\PayU\Configuration\Credentials\TestCredentials;

/**
 * Class ClientTest
 * @package Team3\PayU\Communication
 * @group communication
 */
class ClientTest extends \Codeception\TestCase\Test
{
    const RESPONSE_CONTENT = 'Response content';

    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testResponseContent()
    {
        $client = new ClientAdapter(
            $this->getSender(),
            $this->getCurlRequestBuilder(),
            $this->getLogger()
        );
        $configuration = new Configuration(new TestCredentials());
        $payURequest = $this
            ->getMockBuilder('\Team3\PayU\Communication\Request\PayURequestInterface')
            ->getMock();

        $response = $client->sendRequest($configuration, $payURequest);

        $this->assertInstanceOf(
            'Buzz\Message\Response',
            $response
        );

        $this->assertEquals(
            self::RESPONSE_CONTENT,
            $response->getContent()
        );
    }

    /**
     * @expectedException \Team3\PayU\Communication\ClientException
     */
    public function testCurlsException()
    {
        $client = new ClientAdapter(
            $this->getCurlClientWithException(),
            $this->getCurlRequestBuilder(),
            $this->getLogger()
        );
        $configuration = new Configuration(new TestCredentials());
        $payURequest = $this
            ->getMockBuilder('\Team3\PayU\Communication\Request\PayURequestInterface')
            ->getMock();

        $client->sendRequest($configuration, $payURequest);
    }

    /**
     * @return ClientInterface
     */
    private function getCurlClientWithException()
    {
        $client = $this
            ->getMockBuilder('\Team3\PayU\Communication\Sender\SenderInterface')
            ->getMock();

        $client
            ->expects($this->any())
            ->method('send')
            ->withAnyParameters()
            ->willThrowException(new ClientException());

        return $client;
    }

    /**
     * @return SenderInterface
     */
    private function getSender()
    {
        $client = $this
            ->getMockBuilder('\Team3\PayU\Communication\Sender\SenderInterface')
            ->getMock();

        $client
            ->expects($this->any())
            ->method('send')
            ->willReturnCallback(function () {
                $response = new Response();
                $response->setContent(self::RESPONSE_CONTENT);

                return $response;
            });

        return $client;
    }

    /**
     * @return CurlRequestBuilderInterface
     */
    private function getCurlRequestBuilder()
    {
        $curlRequest = $this
            ->getMockBuilder('Buzz\Message\Request')
            ->getMock();

        $curlRequestBuilder = $this
            ->getMockBuilder('Team3\PayU\Communication\CurlRequestBuilder\CurlRequestBuilder')
            ->disableOriginalConstructor()
            ->getMock();

        $curlRequestBuilder
            ->expects($this->any())
            ->method('build')
            ->withAnyParameters()
            ->willReturn($curlRequest);

        return $curlRequestBuilder;
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
}
