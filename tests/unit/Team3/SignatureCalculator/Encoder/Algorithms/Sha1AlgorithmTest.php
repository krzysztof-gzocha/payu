<?php
namespace Team3\SignatureCalculator\Encoder\Algorithms;

/**
 * Class Sha1AlgorithmTest
 * @package Team3\SignatureCalculator\Encoder\Algorithms
 * @group signature
 */
class Sha1AlgorithmTest extends \Codeception\TestCase\Test
{
    const NAME = 'SHA1';

    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testName()
    {
        $algorithm = new Sha1Algorithm();
        $this->assertEquals(self::NAME, $algorithm->getName());
    }
}
