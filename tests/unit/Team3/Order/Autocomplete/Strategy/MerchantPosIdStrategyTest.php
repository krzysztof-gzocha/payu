<?php
namespace Team3\Order\Autocomplete\Strategy;

use Team3\Configuration\Configuration;
use Team3\Configuration\ConfigurationInterface;
use Team3\Configuration\Credentials\TestCredentials;
use Team3\Order\Model\Order;

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
