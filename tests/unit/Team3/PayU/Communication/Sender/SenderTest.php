<?php
namespace Team3\PayU\Communication\Sender;


use Buzz\Client\ClientInterface;
use Buzz\Message\RequestInterface;
use Buzz\Message\Response;
use Psr\Log\LoggerInterface;
use Team3\PayU\Configuration\Credentials\CredentialsInterface;
use Team3\PayU\Configuration\Credentials\TestCredentials;

class SenderTest extends \Codeception\TestCase\Test
{
    const RESPONSE_CONTENT = 'Received content.';
    const CURL_EXCEPTION = 'Curl exception';
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testResult()
    {
        $sender = new Sender($this->getCurlClient(), $this->getLogger());

        /** @var Response $response */
        $response = $sender->send($this->getCurlRequest(), $this->getCredentials());

        $this->assertInstanceOf(
            '\Buzz\Message\Response',
            $response
        );

        $this->assertEquals(
            self::RESPONSE_CONTENT,
            $response->getContent()
        );
    }

    /**
     * @throws \Team3\PayU\Communication\ClientException
     * @expectedException \Team3\PayU\Communication\ClientException
     */
    public function testException()
    {
        $sender = new Sender($this->getCurlClientWithException(), $this->getLogger());
        $sender->send($this->getCurlRequest(), $this->getCredentials());
    }

    /**
     * @return ClientInterface
     */
    private function getCurlClient()
    {
        $curl = $this
            ->getMockBuilder('\Buzz\Client\ClientInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $curl
            ->expects($this->any())
            ->method('send')
            ->willReturnCallback(function ($request, Response $response, $options) {
                $response->setContent(self::RESPONSE_CONTENT);
            });

        return $curl;
    }

    /**
     * @return ClientInterface
     */
    private function getCurlClientWithException()
    {
        $curl = $this
            ->getMockBuilder('\Buzz\Client\ClientInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $curl
            ->expects($this->any())
            ->method('send')
            ->willThrowException(new \Exception(self::CURL_EXCEPTION));

        return $curl;
    }

    /**
     * @return LoggerInterface
     */
    private function getLogger()
    {
        return $this
            ->getMock('Psr\Log\LoggerInterface');
    }

    /**
     * @return RequestInterface
     */
    private function getCurlRequest()
    {
        return $this
            ->getMock('\Buzz\Message\RequestInterface');
    }

    /**
     * @return CredentialsInterface
     */
    private function getCredentials()
    {
        return new TestCredentials();
    }
}
