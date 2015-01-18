<?php
namespace Team3\Configuration;

use Team3\Configuration\Credentials\Credentials;
use Team3\Configuration\Credentials\TestCredentials;
use Team3\SignatureCalculator\Encoder\Algorithms\Md5Algorithm;

class TestCredentialsTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testTestCredentials()
    {
        $testCredentials = new TestCredentials();

        $this->assertEquals(
            TestCredentials::MERCHANT_POS_ID,
            $testCredentials->getMerchantPosId()
        );

        $this->assertEquals(
            TestCredentials::PRIVATE_KEY,
            $testCredentials->getPrivateKey()
        );

        $this->assertInstanceOf(
            '\Team3\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface',
            $testCredentials->getSignatureAlgorithm()
        );

        $this->assertEquals(
            'TLSv1',
            $testCredentials->getEncryptionProtocols()
        );
    }

    public function testIfCredentialsAreRight()
    {
        $testCredentials = new TestCredentials();

        $this->assertEquals(
            '145227',
            $testCredentials->getMerchantPosId()
        );

        $this->assertEquals(
            '13a980d4f851f3d9a1cfc792fb1f5e50',
            $testCredentials->getPrivateKey()
        );
    }
}
