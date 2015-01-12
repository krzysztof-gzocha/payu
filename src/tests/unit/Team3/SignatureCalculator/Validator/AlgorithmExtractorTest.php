<?php
namespace Team3\SignatureCalculator\Validator;

use Team3\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;

/**
 * Class AlgorithmExtractorTest
 * @package Team3\SignatureCalculator\Validator
 * @group signature
 */
class AlgorithmExtractorTest extends \Codeception\TestCase\Test
{
    const ALGORITHM_NAME = 'MD5';

    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @link http://developers.payu.com/pl/restapi.html#order_common_reference_verification_of_notifications_signature
     */
    public function testExtractedAlgorithm()
    {
        $signatureHeader = sprintf(
            'sender=checkout;signature=c33a38d89fb60f873c039fcec3a14743;algorithm=%s;content=DOCUMENT',
            self::ALGORITHM_NAME
        );
        $algorithmExtractor = new AlgorithmExtractor();
        $algorithm = $algorithmExtractor->extractAlgorithm($signatureHeader, $this->getAlgorithms());

        $this->assertInstanceOf(
            '\Team3\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface',
            $algorithm
        );

        $this->assertEquals(
            self::ALGORITHM_NAME,
            $algorithm->getName()
        );
    }

    /**
     * @throws AlgorithmExtractorException
     * @expectedException \Team3\SignatureCalculator\Validator\AlgorithmExtractorException
     */
    public function testExtractionWithCorruptedString()
    {
        $corruptedHeader = 'some corrupted header';
        $algorithmExtractor = new AlgorithmExtractor();
        $algorithmExtractor->extractAlgorithm($corruptedHeader, $this->getAlgorithms());
    }

    /**
     * @throws AlgorithmExtractorException
     * @expectedException \Team3\SignatureCalculator\Validator\AlgorithmExtractorException
     */
    public function testExtractionWithNoAlgorithms()
    {
        $signatureHeader = sprintf(
            'sender=checkout;signature=c33a38d89fb60f873c039fcec3a14743;algorithm=%s;content=DOCUMENT',
            self::ALGORITHM_NAME
        );
        $algorithmExtractor = new AlgorithmExtractor();
        $algorithmExtractor->extractAlgorithm($signatureHeader, []);
    }

    /**
     * @return AlgorithmInterface[]
     */
    private function getAlgorithms()
    {
        return [
            $this->getAlgorithm(self::ALGORITHM_NAME),
            $this->getAlgorithm('otherAlgorithm'),
            $this->getAlgorithm('randomName')
        ];
    }

    /**
     * @param $name
     * @return AlgorithmInterface
     */
    private function getAlgorithm($name)
    {
        $algorithm = $this
            ->getMock('\Team3\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface');

        $algorithm
            ->expects($this->any())
            ->method('getName')
            ->willReturn($name);

        return $algorithm;
    }
}
