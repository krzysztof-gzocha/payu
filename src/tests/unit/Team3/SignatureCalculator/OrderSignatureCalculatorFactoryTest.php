<?php
namespace Team3\SignatureCalculator;

class OrderSignatureCalculatorFactoryTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testResult()
    {
        $factory = new OrderSignatureCalculatorFactory();

        $this->assertInstanceOf(
            'Team3\SignatureCalculator\OrderSignatureCalculatorInterface',
            $factory->build($this->getLogger())
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
