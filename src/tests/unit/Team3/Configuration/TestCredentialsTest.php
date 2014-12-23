<?php
namespace Team3\Configuration;

use Team3\Configuration\Credentials\TestCredentials;

class TestCredentialsTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testCredentials()
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
