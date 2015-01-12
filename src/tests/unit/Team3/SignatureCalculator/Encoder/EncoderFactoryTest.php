<?php
namespace Team3\SignatureCalculator\Encoder;

class EncoderFactoryTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testResult()
    {
        $factory = new EncoderFactory();

        $this->assertInstanceOf(
            'Team3\SignatureCalculator\Encoder\EncoderInterface',
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
