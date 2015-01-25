<?php
namespace Team3\PayU\Configuration\Credentials;


use Team3\PayU\SignatureCalculator\Encoder\Algorithms\Md5Algorithm;

class CredentialsTest extends \Codeception\TestCase\Test
{
    const MERCHANT = 'merchant';
    const PRIVATE_KEY = 'private';
    const ENCRYPTION_PROTOCOL = 'encryptionProtocol';

    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testCredentials()
    {
        $credentials = new Credentials(
            self::MERCHANT,
            self::PRIVATE_KEY,
            new Md5Algorithm(),
            self::ENCRYPTION_PROTOCOL
        );

        $this->assertEquals(
            self::MERCHANT,
            $credentials->getMerchantPosId()
        );
        $this->assertEquals(
            self::PRIVATE_KEY,
            $credentials->getPrivateKey()
        );
        $this->assertEquals(
            self::ENCRYPTION_PROTOCOL,
            $credentials->getEncryptionProtocols()
        );
        $this->assertInstanceOf(
            '\Team3\PayU\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface',
            $credentials->getSignatureAlgorithm()
        );
    }
}
