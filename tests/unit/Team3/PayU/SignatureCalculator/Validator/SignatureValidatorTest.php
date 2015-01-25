<?php
namespace Team3\PayU\SignatureCalculator\Validator;

use Team3\PayU\Configuration\Credentials\TestCredentials;
use Team3\PayU\SignatureCalculator\Encoder\Algorithms\AlgorithmsProviderInterface;
use Team3\PayU\SignatureCalculator\Encoder\Algorithms\Md5Algorithm;
use Team3\PayU\SignatureCalculator\Encoder\Algorithms\Sha1Algorithm;
use Team3\PayU\SignatureCalculator\Encoder\Algorithms\Sha256Algorithm;
use Team3\PayU\SignatureCalculator\SignatureCalculatorInterface;

class SignatureValidatorTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testResult()
    {
        $validator = new SignatureValidator(
            $this->getSignatureCalculator('123'),
            $this->getAlgorithmExtractor(),
            $this->getAlgorithmsProvider()
        );

        $this->assertTrue(
            $validator->isSignatureValid('{"order":"test"}', 'signature=123;algorithm=s;', new TestCredentials(), [])
        );

        $validator = new SignatureValidator(
            $this->getSignatureCalculator('wrongSignature'),
            $this->getAlgorithmExtractor(),
            $this->getAlgorithmsProvider()
        );

        $this->assertFalse(
            $validator->isSignatureValid('{"order":"test"}', 'signature=123;algorithm=s;', new TestCredentials(), [])
        );
    }

    /**
     * @expectedException \Team3\PayU\SignatureCalculator\Validator\SignatureValidatorException
     */
    public function testException()
    {
        $validator = new SignatureValidator(
            $this->getSignatureCalculator('123'),
            $this->getAlgorithmExtractor(),
            $this->getAlgorithmsProvider()
        );

        $validator->isSignatureValid('{"order":"test"}', 'wrong signature header', new TestCredentials(), []);
    }

    /**
     * @return AlgorithmsProviderInterface
     */
    private function getAlgorithmsProvider()
    {
        $provider = $this->getMock('\Team3\PayU\SignatureCalculator\Encoder\Algorithms\AlgorithmsProviderInterface');
        $provider
            ->expects($this->any())
            ->method('getAlgorithms')
            ->willReturn([
                new Md5Algorithm(),
                new Sha1Algorithm(),
                new Sha256Algorithm(),
            ]);

        return $provider;
    }

    /**
     * @return AlgorithmExtractorInterface
     */
    private function getAlgorithmExtractor()
    {
        $algorithm = $this
            ->getMock('Team3\PayU\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface');

        $extractor = $this
            ->getMock('Team3\PayU\SignatureCalculator\Validator\AlgorithmExtractorInterface');

        $extractor
            ->expects($this->any())
            ->method('extractAlgorithm')
            ->willReturn($algorithm);

        return $extractor;
    }

    /**
     * @param $return
     *
     * @return SignatureCalculatorInterface
     */
    private function getSignatureCalculator($return)
    {
        $calculator = $this
            ->getMock('Team3\PayU\SignatureCalculator\SignatureCalculatorInterface');

        $calculator
            ->expects($this->any())
            ->method('calculate')
            ->withAnyParameters()
            ->willReturn($return);

        return $calculator;
    }
}
