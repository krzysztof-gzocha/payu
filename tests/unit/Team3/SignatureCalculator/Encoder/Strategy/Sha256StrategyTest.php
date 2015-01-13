<?php
namespace Team3\SignatureCalculator\Encoder\Strategy;

use Team3\SignatureCalculator\Encoder\Algorithms\Sha256Algorithm;

function function_exists()
{
    if (defined('MOCKING_FUNCTION_EXISTS')) {
        return false;
    }

    return true;
}

/**
 * Class Sha256StrategyTestWithoutHash
 * @package Team3\SignatureCalculator\Encoder\Strategy
 * @group signature
 */
class Sha256StrategyTest extends \Codeception\TestCase\Test
{
    const DATA = '123';
    const HASH = 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3';

    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testIfHashIsCorrect()
    {
        $strategy = new Sha256Strategy();

        $this->assertEquals(
            self::HASH,
            $strategy->encode(self::DATA)
        );
    }

    public function testIfSupportsAlgorithm()
    {
        $strategy = new Sha256Strategy();
        $algorithm = new Sha256Algorithm();

        $this->assertTrue($strategy->supports($algorithm));
    }

    /**
     * @throws \Team3\SignatureCalculator\Encoder\EncoderException
     * @expectedException \Team3\SignatureCalculator\Encoder\EncoderException
     */
    public function testWhenNoHashFunction()
    {
        define('MOCKING_FUNCTION_EXISTS', 1);
        $strategy = new Sha256Strategy();
        $algorithm = new Sha256Algorithm();

        $strategy->encode('123', $algorithm);
    }
}
