<?php
namespace Team3\PayU\Order\Transformer\UserOrder\Strategy;

use Team3\PayU\Order\Transformer\UserOrder\UserOrderTransformerInterface;
use Team3\PayU\PropertyExtractor\ExtractorInterface;

class UserOrderTransformerStrategiesProviderTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testResult()
    {
        $provider = new UserOrderTransformerStrategiesProvider();

        $result = $provider->getStrategies($this->getExtractor(), $this->getTransformer());

        $this->assertTrue(is_array($result));
        $this->assertGreaterThan(
            0,
            count($result)
        );
        /** @var UserOrderTransformerStrategyInterface $strategy */
        foreach ($result as $strategy) {
            $this->assertInstanceOf(
                '\Team3\PayU\Order\Transformer\UserOrder\Strategy\UserOrderTransformerStrategyInterface',
                $strategy
            );
        }
    }

    /**
     * @return ExtractorInterface
     */
    private function getExtractor()
    {
        return $this
            ->getMockBuilder('\Team3\PayU\PropertyExtractor\ExtractorInterface')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return UserOrderTransformerInterface
     */
    private function getTransformer()
    {
        return $this
            ->getMockBuilder('\Team3\PayU\Order\Transformer\UserOrder\UserOrderTransformerInterface')
            ->disableOriginalConstructor()
            ->getMock();
    }
}
