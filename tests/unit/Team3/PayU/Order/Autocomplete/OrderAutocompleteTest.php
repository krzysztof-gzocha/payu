<?php
namespace Team3\PayU\Order\Autocomplete;

use Psr\Log\LoggerInterface;
use Team3\PayU\Configuration\Configuration;
use Team3\PayU\Configuration\ConfigurationInterface;
use Team3\PayU\Configuration\Credentials\TestCredentials;
use Team3\PayU\Order\Autocomplete\Strategy\AutocompleteStrategyInterface;
use Team3\PayU\Order\Model\Order;
use Team3\PayU\Order\Model\OrderInterface;

class OrderAutocompleteTest extends \Codeception\TestCase\Test
{
    const ORDER_ID = '123';
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

    public function testIfNoExceptionWhenNoStrategies()
    {
        $autocomplete = new OrderAutocomplete($this->getLogger());
        $autocomplete->autocomplete(new Order(), $this->configuration);
    }

    public function testAddingStrategy()
    {
        $autocomplete = new OrderAutocomplete($this->getLogger());
        $autocomplete->addStrategy($this->getStrategy());
        $autocomplete->autocomplete($order = new Order(), $this->configuration);
        $this->assertEquals(
            self::ORDER_ID,
            $order->getOrderId()
        );
    }

    public function testRespectingSupportMethod()
    {
        $autocomplete = new OrderAutocomplete($this->getLogger());
        $autocomplete->addStrategy($this->getStrategy(false));
        $autocomplete->autocomplete($order = new Order(), $this->configuration);
        $this->assertNull(
            $order->getOrderId()
        );
    }

    /**
     * @return AutocompleteStrategyInterface
     */
    private function getStrategy($supports = true)
    {
        $strategy = $this
            ->getMock('\Team3\PayU\Order\Autocomplete\Strategy\AutocompleteStrategyInterface');
        $strategy
            ->expects($this->any())
            ->method('supports')
            ->willReturn($supports);

        $strategy
            ->expects($this->any())
            ->method('autocomplete')
            ->willReturnCallback(function (OrderInterface $order, ConfigurationInterface $configuration) {
                $order->setOrderId(self::ORDER_ID);
            });

        return $strategy;
    }

    /**
     * @return LoggerInterface
     */
    private function getLogger()
    {
        return $this
            ->getMock('Psr\Log\LoggerInterface');
    }
}
