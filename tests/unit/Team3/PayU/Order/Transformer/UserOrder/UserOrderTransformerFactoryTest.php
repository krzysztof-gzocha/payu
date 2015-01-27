<?php
namespace Team3\PayU\Order\Transformer\UserOrder;


use Psr\Log\LoggerInterface;

class UserOrderTransformerFactoryTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testResult()
    {
        $factory = new UserOrderTransformerFactory();

        $this->assertInstanceOf(
            '\Team3\PayU\Order\Transformer\UserOrder\UserOrderTransformerInterface',
            $factory->build($this->getLogger())
        );
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
