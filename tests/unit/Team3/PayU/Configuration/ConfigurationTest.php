<?php
namespace Team3\PayU\Configuration\Credentials;

use Team3\PayU\Configuration\Configuration;

class ConfigurationTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testDefaultConfiguration()
    {
        $configuration = new Configuration(
            new TestCredentials()
        );

        $this->assertInstanceOf(
            'Team3\PayU\Configuration\Credentials\CredentialsInterface',
            $configuration->getCredentials()
        );

        $this->assertEquals(
            'https',
            $configuration->getProtocol()
        );

        $this->assertEquals(
            'secure.payu.com',
            $configuration->getDomain()
        );

        $this->assertEquals(
            'api',
            $configuration->getPath()
        );

        $this->assertEquals(
            'v2_1',
            $configuration->getVersion()
        );

        $this->assertInstanceOf(
            'Team3\PayU\Configuration\Credentials\TestCredentials',
            $configuration->getCredentials()
        );

        $this->assertEquals(
            'https://secure.payu.com/api/v2_1',
            $configuration->getAPIUrl()
        );
    }
}
