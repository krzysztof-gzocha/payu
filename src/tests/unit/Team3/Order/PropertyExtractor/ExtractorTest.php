<?php
namespace Team3\Order\PropertyExtractor;

use Codeception\TestCase;
use Team3\Order\PropertyExtractor\Reader\ReaderInterface;
use Team3\Order\PropertyExtractor\Reader\ReaderResult;
use tests\unit\Team3\Order\PropertyExtractor\Model;

class ExtractorTest extends \Codeception\TestCase\Test
{
    const ANNOTATION_PROPERTY_NAME = 'test';
    const MODELS_METHOD_NAME = 'method';

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
        $reader = $this->getMock(ReaderInterface::class);
        $reader
            ->expects($this->any())
            ->method('read')
            ->willReturn([new ReaderResult(self::MODELS_METHOD_NAME, self::ANNOTATION_PROPERTY_NAME)]);

        $this->extractor = new Extractor($reader);
    }

    public function testResult()
    {
        $results = $this->extractor->extract($model = new Model());
        $this->assertCount(1, $results);

        /** @var ExtractorResult $firstResult */
        $firstResult = array_pop($results);

        $this->assertInstanceOf(
            'Team3\Order\PropertyExtractor\ExtractorResult',
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
     * @expectedException Team3\Order\PropertyExtractor\ExtractorException
     */
    public function testThrowingExceptionWhenNoObjectGiven()
    {
        $this->extractor->extract('test');
    }

    /**
     * @expectedException Team3\Order\PropertyExtractor\ExtractorException
     */
    public function testThrowingExceptionWhenWrongMethodReturned()
    {
        $reader = $this->getMock(ReaderInterface::class);
        $reader
            ->expects($this->any())
            ->method('read')
            ->willReturn([new ReaderResult('wrongMethod', self::ANNOTATION_PROPERTY_NAME)]);

        $extractor = new Extractor($reader);
        $this->extractor->extract(new \stdClass());
    }
}
