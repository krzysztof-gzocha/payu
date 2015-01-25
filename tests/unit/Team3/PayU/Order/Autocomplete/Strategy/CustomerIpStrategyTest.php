<?php
namespace Team3\PayU\Order\Autocomplete\Strategy;

use Team3\PayU\Configuration\Configuration;
use Team3\PayU\Configuration\Credentials\TestCredentials;
use Team3\PayU\Order\Model\Order;

function getenv($variable)
{
    return $variable;
}

class CustomerIpStrategyTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected $configuration;

    public function _before()
    {
        $this->configuration = new Configuration(new TestCredentials());
    }

    public function testCompletion()
    {
        $customer = new CustomerIpStrategy();
        $customer->autocomplete($order = new Order(), $this->configuration);

        $this->assertEquals(
            'REMOTE_ADDR',
            $order->getCustomerIp()
        );
    }

    public function testSupport()
    {
        $customer = new CustomerIpStrategy();

        $this->assertTrue($customer->supports($order = new Order()));
        $order->setCustomerIp('123');
        $this->assertFalse($customer->supports($order));
    }
}
