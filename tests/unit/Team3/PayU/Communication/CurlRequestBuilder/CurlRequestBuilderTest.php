<?php
namespace Team3\PayU\Communication\CurlRequestBuilder;

use Team3\PayU\Communication\Request\PayURequestInterface;
use Team3\PayU\Configuration\Configuration;
use Team3\PayU\Configuration\Credentials\TestCredentials;
use Team3\PayU\Order\Model\Order;
use Team3\PayU\Serializer\SerializerInterface;

/**
 * Class CurlRequestBuilderTest
 * @package Team3\PayU\Communication\CurlRequestBuilder
 * @group communication
 */
class CurlRequestBuilderTest extends \Codeception\TestCase\Test
{
    const DATA = 'DATA';
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testResults()
    {
        $builder = new CurlRequestBuilder($this->getSerializer());
        $configuration = new Configuration(new TestCredentials());

        $payURequest = $this->getPayURequest();
        $curlRequest = $builder->build($configuration, $payURequest);

        $this->assertEquals(
            'POST',
            $curlRequest->getMethod()
        );

        $this->assertEquals(
            sprintf('%s://%s/', $configuration->getProtocol(), $configuration->getDomain()),
            $curlRequest->getHost()
        );

        $this->assertEquals(
            self::DATA,
            $curlRequest->getContent()
        );

        $this->assertEquals(
            sprintf(
                '%s/%s/%s',
                $configuration->getPath(),
                $configuration->getVersion(),
                $payURequest->getPath()
            ),
            $curlRequest->getResource()
        );
    }

    /**
     * @return PayURequestInterface
     */
    private function getPayURequest()
    {
        $payURequest = $this
            ->getMockBuilder('Team3\PayU\Communication\Request\PayURequestInterface')
            ->getMock();
        $payURequest
            ->expects($this->any())
            ->method('getDataObject')
            ->willReturn(new Order());
        $payURequest
            ->expects($this->any())
            ->method('getPath')
            ->willReturn('path');
        $payURequest
            ->expects($this->any())
            ->method('getMethod')
            ->willReturn('POST');

        return $payURequest;
    }

    /**
     * @return SerializerInterface
     */
    private function getSerializer()
    {
        $serializer = $this
            ->getMockBuilder('Team3\PayU\Serializer\SerializerInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $serializer
            ->expects($this->any())
            ->method('toJson')
            ->withAnyParameters()
            ->willReturn(self::DATA);

        return $serializer;
    }
}
