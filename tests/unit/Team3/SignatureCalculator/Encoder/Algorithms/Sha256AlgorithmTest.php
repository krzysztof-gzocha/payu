<?php
namespace Team3\SignatureCalculator\Encoder\Algorithms;

/**
 * Class Sha256AlgorithmTest
 * @package Team3\SignatureCalculator\Encoder\Algorithms
 * @group signature
 */
class Sha256AlgorithmTest extends \Codeception\TestCase\Test
{
    const NAME = 'SHA256';

    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testName()
    {
        $algorithm = new Sha256Algorithm();
        $this->assertEquals(self::NAME, $algorithm->getName());
    }
}
