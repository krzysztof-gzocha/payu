<?php
namespace Team3\PayU\Order\Autocomplete;

class OrderAutocompleteFactoryTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testResult()
    {
        $factory = new OrderAutocompleteFactory();

        $orderAutocomplete = $factory->build($this->getLogger());
        $this->assertInstanceOf(
            '\Team3\PayU\Order\Autocomplete\OrderAutocomplete',
            $orderAutocomplete
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getLogger()
    {
        return $this
            ->getMock('Psr\Log\LoggerInterface');
    }
}
