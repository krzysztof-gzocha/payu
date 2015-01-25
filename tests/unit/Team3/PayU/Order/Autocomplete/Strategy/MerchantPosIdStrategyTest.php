<?php
namespace Team3\PayU\Order\Autocomplete\Strategy;

use Team3\PayU\Configuration\Configuration;
use Team3\PayU\Configuration\ConfigurationInterface;
use Team3\PayU\Configuration\Credentials\TestCredentials;
use Team3\PayU\Order\Model\Order;

class MerchantPosIdStrategyTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var ConfigurationInterface
     */
    protected $configuration;

    protected function _before()
    {
        $this->configuration = new Configuration(new TestCredentials());
    }

    public function testAutocomplete()
    {
        $merchant = new MerchantPosIdStrategy();
        $merchant->autocomplete($order = new Order(), $this->configuration);
        $this->assertEquals(
            $order->getMerchantPosId(),
            $this->configuration->getCredentials()->getMerchantPosId()
        );
    }

    public function testSupport()
    {
        $merchant = new MerchantPosIdStrategy();

        $this->assertTrue(
            $merchant->supports($order = new Order())
        );
        $order->setMerchantPosId('123');
        $this->assertFalse($merchant->supports($order));
    }
}
