<?php
namespace Team3\SignatureCalculator\Encoder\Algorithms;

/**
 * Class Md5AlgorithmTest
 * @package Team3\SignatureCalculator\Encoder\Algorithms
 * @group signature
 */
class Md5AlgorithmTest extends \Codeception\TestCase\Test
{
    const NAME = 'MD5';

    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testName()
    {
        $algorithm = new Md5Algorithm();
        $this->assertEquals(self::NAME, $algorithm->getName());
    }
}
