<?php
namespace Team3\SignatureCalculator\Encoder\Algorithms;

/**
 * Class AlgorithmsProviderTest
 * @package Team3\SignatureCalculator\Encoder\Algorithms
 * @group signature
 */
class AlgorithmsProviderTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testResults()
    {
        $provider = new AlgorithmsProvider();
        $algorithms = $provider->getAlgorithms();
        $this->assertTrue(
            is_array($algorithms)
        );

        foreach ($algorithms as $algorithm) {
            $this->assertInstanceOf(
                'Team3\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface',
                $algorithm
            );
        }
    }
}
