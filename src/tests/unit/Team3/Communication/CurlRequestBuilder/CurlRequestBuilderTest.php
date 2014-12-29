<?php
namespace Team3\Communication\CurlRequestBuilder;

use Team3\Communication\Request\PayURequestInterface;
use Team3\Configuration\Configuration;
use Team3\Configuration\Credentials\TestCredentials;

/**
 * Class CurlRequestBuilderTest
 * @package Team3\Communication\CurlRequestBuilder
 * @group communication
 */
class CurlRequestBuilderTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testResults()
    {
        $builder = new CurlRequestBuilder();
        $configuration = new Configuration(new TestCredentials());

        $payURequest = $this->getPayURequest();
        $curlRequest = $builder->build($configuration, $payURequest);

        $this->assertEquals(
            'POST',
            $curlRequest->getMethod()
        );

        $this->assertEquals(
            $configuration->getDomain(),
            $curlRequest->getHost()
        );

        $this->assertEquals(
            $payURequest->getData(),
            $curlRequest->getContent()
        );

        $this->assertEquals(
            $payURequest->getPath(),
            $curlRequest->getResource()
        );
    }

    /**
     * @return PayURequestInterface
     */
    private function getPayURequest()
    {
        $payURequest = $this
            ->getMockBuilder('Team3\Communication\Request\PayURequestInterface')
            ->getMock();
        $payURequest
            ->expects($this->any())
            ->method('getData')
            ->willReturn('DATA');
        $payURequest
            ->expects($this->any())
            ->method('getPath')
            ->willReturn('/path');

        return $payURequest;
    }
}
