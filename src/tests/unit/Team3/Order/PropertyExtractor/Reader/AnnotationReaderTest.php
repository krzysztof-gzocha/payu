<?php
namespace Team3\Order\PropertyExtractor\Reader;


use Doctrine\Common\Annotations\AnnotationReader as DoctrineAnnotationReader;

class AnnotationReaderTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @expectedException Team3\Order\PropertyExtractor\ExtractorException
     */
    public function testIfExceptionIsThrown()
    {
        $ar = new AnnotationReader(new DoctrineAnnotationReader());

        $ar->read('not-object');
    }
}
