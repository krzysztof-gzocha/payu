<?php
namespace Team3\PayU\PropertyExtractor;

use Codeception\TestCase;
use Psr\Log\LoggerInterface;
use Team3\PayU\PropertyExtractor\Reader\ReaderResult;
use tests\unit\Team3\PayU\PropertyExtractor\Model;

class ExtractorTest extends \Codeception\TestCase\Test
{
    const ANNOTATION_PROPERTY_NAME = 'test';
    const MODELS_METHOD_NAME = 'method';
    const READER_INTERFACE = '\Team3\PayU\PropertyExtractor\Reader\ReaderInterface';

    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var ExtractorInterface
     */
    protected $extractor;

    /**
     * @inheritdoc
     */
    protected function _before()
    {
        $reader = $this->getMock(self::READER_INTERFACE);
        $reader
            ->expects($this->any())
            ->method('read')
            ->willReturn([new ReaderResult(self::MODELS_METHOD_NAME, self::ANNOTATION_PROPERTY_NAME)]);

        $this->extractor = new Extractor($reader, $this->getLogger());
    }

    public function testResult()
    {
        $results = $this->extractor->extract($model = new Model());
        $this->assertCount(1, $results);

        /** @var ExtractorResult $firstResult */
        $firstResult = array_pop($results);

        $this->assertInstanceOf(
            'Team3\PayU\PropertyExtractor\ExtractorResult',
            $firstResult
        );
        $this->assertEquals(
            self::ANNOTATION_PROPERTY_NAME,
            $firstResult->getPropertyName()
        );
        $this->assertEquals(
            (new \ReflectionClass($model))->getMethod(self::MODELS_METHOD_NAME)->invoke($model),
            $firstResult->getValue()
        );
    }

    /**
     * @expectedException \Team3\PayU\PropertyExtractor\ExtractorException
     */
    public function testThrowingExceptionWhenWrongClassNameGiven()
    {
        $this->extractor->extract('test');
    }

    /**
     * @expectedException \Team3\PayU\PropertyExtractor\ExtractorException
     */
    public function testThrowingExceptionWhenArrayGiven()
    {
        $this->extractor->extract([]);
    }

    /**
     * @expectedException \Team3\PayU\PropertyExtractor\ExtractorException
     */
    public function testThrowingExceptionWhenWrongMethodReturned()
    {
        $reader = $this->getMock(self::READER_INTERFACE);
        $reader
            ->expects($this->any())
            ->method('read')
            ->willReturn([new ReaderResult('wrongMethod', self::ANNOTATION_PROPERTY_NAME)]);

        $extractor = new Extractor($reader, $this->getLogger());
        $extractor->extract(new \stdClass());
    }

    /**
     * @return LoggerInterface
     */
    private function getLogger()
    {
        return $this->getMock('Psr\Log\LoggerInterface');
    }
}
