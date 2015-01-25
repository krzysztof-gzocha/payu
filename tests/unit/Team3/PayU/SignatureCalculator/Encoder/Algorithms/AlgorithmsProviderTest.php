<?php
namespace Team3\PayU\SignatureCalculator\Encoder\Algorithms;

/**
 * Class AlgorithmsProviderTest
 * @package Team3\PayU\SignatureCalculator\Encoder\Algorithms
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
                'Team3\PayU\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface',
                $algorithm
            );
        }
    }
}
