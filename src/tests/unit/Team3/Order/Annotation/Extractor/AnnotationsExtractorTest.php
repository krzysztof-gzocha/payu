<?php
namespace Team3\Order\Annotation\Extractor;

use Codeception\TestCase;
use Doctrine\Common\Annotations\AnnotationReader;
use Team3\Order\Annotation\PayU;
use tests\unit\Team3\Order\Annotation\Extractor\Model;

class AnnotationsExtractorTest extends \Codeception\TestCase\Test
{
    const ANNOTATION_PROPERTY_NAME = 'test';
    const MODELS_METHOD_NAME = 'method';

    /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var AnnotationsExtractorInterface
     */
    protected $annotationsExtractor;

    /**
     * @inheritdoc
     */
    protected function _before()
    {
        $payu = new PayU();
        $payu->propertyName = self::ANNOTATION_PROPERTY_NAME;

        $annotationReader = $this->getMock(AnnotationReader::class);
        $annotationReader
            ->expects($this->any())
            ->method('getMethodAnnotation')
            ->willReturn($payu);

        $this->annotationsExtractor = new AnnotationsExtractor(
            $annotationReader
        );
    }

    public function testResult()
    {
        $results = $this->annotationsExtractor->extractAnnotations($model = new Model());
        $this->assertCount(1, $results);

        /** @var AnnotationsExtractorResult $firstResult */
        $firstResult = array_pop($results);

        $this->assertInstanceOf(
            'Team3\Order\Annotation\Extractor\AnnotationsExtractorResult',
            $firstResult
        );
        $this->assertInstanceOf(
            PayU::class,
            $firstResult->getAnnotation()
        );
        $this->assertEquals(
            self::ANNOTATION_PROPERTY_NAME,
            $firstResult->getAnnotation()->getPropertyName()
        );
        $this->assertEquals(
            (new \ReflectionClass($model))->getMethod(self::MODELS_METHOD_NAME),
            $firstResult->getReflectionMethod()
        );
    }

    public function testThrowingExceptionWhenNoObjectGiven()
    {
        $this->setExpectedException(AnnotationsextractorException::class);
        $this->annotationsExtractor->extractAnnotations('test');
    }
}
