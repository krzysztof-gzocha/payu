<?php
namespace Team3\SignatureCalculator\Encoder\Algorithms;

/**
 * Class AbstractAlgorithmTest
 * @package Team3\SignatureCalculator\Encoder\Algorithms
 * @group signature
 */
class AbstractAlgorithmTest extends \Codeception\TestCase\Test
{
    const ALGORITHM_NAME = 'algorithmName';
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testToStringMethod()
    {
        $algorithmMock = $this
            ->getMockForAbstractClass('\Team3\SignatureCalculator\Encoder\Algorithms\AbstractAlgorithm');
        $algorithmMock
            ->expects($this->any())
            ->method('getName')
            ->willReturn(self::ALGORITHM_NAME);

        $this->assertEquals(
            self::ALGORITHM_NAME,
            $algorithmMock->__toString()
        );
    }
}
