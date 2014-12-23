<?php
namespace Team3\SignatureCalculator\Encoder\Strategy;

use Team3\SignatureCalculator\Encoder\Algorithms\Md5Algorithm;

/**
 * Class Md5StrategyTest
 * @package Team3\SignatureCalculator\Encoder\Strategy
 * @group signature
 */
class Md5StrategyTest extends \Codeception\TestCase\Test
{
    const DATA = '123';
    const HASH = '202cb962ac59075b964b07152d234b70';

    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testIfHashIsCorrect()
    {
        $md5Strategy = new Md5Strategy();
        $this->assertEquals(
            self::HASH,
            $md5Strategy->encode(self::DATA)
        );
    }

    public function testIfSupportCorrectAlgorithm()
    {
        $md5Strategy = new Md5Strategy();
        $algorithm = new Md5Algorithm();

        $this->assertTrue($md5Strategy->supports($algorithm));
    }
}
