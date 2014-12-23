<?php
namespace Team3\SignatureCalculator\Encoder\Strategy;

use Team3\SignatureCalculator\Encoder\Algorithms\Sha1Algorithm;

/**
 * Class Sha1StrategyTest
 * @package Team3\SignatureCalculator\Encoder\Strategy
 * @group signature
 */
class Sha1StrategyTest extends \Codeception\TestCase\Test
{
    const DATA = '123';
    const HASH = '40bd001563085fc35165329ea1ff5c5ecbdbbeef';

    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testIfHashIsCorrect()
    {
        $strategy = new Sha1Strategy();

        $this->assertEquals(
            self::HASH,
            $strategy->encode(self::DATA)
        );
    }

    public function testIfSupportAlgorithm()
    {
        $strategy = new Sha1Strategy();
        $algorithm = new Sha1Algorithm();

        $this->assertTrue($strategy->supports($algorithm));
    }
}
