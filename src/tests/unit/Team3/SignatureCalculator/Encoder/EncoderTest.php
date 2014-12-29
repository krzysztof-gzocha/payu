<?php
namespace Team3\SignatureCalculator\Encoder;

use Psr\Log\LoggerInterface;
use Team3\SignatureCalculator\Encoder\Algorithms\Md5Algorithm;
use Team3\SignatureCalculator\Encoder\Strategy\Md5Strategy;

/**
 * Class EncoderTest
 * @package Team3\SignatureCalculator\Encoder
 * @group signature
 */
class EncoderTest extends \Codeception\TestCase\Test
{
    const DATA = '123';
    const HASH = '202cb962ac59075b964b07152d234b70';

    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testIfStrategiesAreUsed()
    {
        $encoder = new Encoder($this->getLogger());
        $encoder->addStrategy(new Md5Strategy());

        $this->assertEquals(
            self::HASH,
            $encoder->encode(self::DATA, new Md5Algorithm())
        );
    }

    /**
     * @throws EncoderException
     * @expectedException \Team3\SignatureCalculator\Encoder\EncoderException
     */
    public function testExceptionWhenNoStrategies()
    {
        $encoder = new Encoder($this->getLogger());
        $encoder->encode(self::DATA, new Md5Algorithm());
    }

    /**
     * @return LoggerInterface
     */
    private function getLogger()
    {
        $logger = $this->getMockBuilder('Psr\Log\LoggerInterface')->getMock();

        return $logger;
    }
}
