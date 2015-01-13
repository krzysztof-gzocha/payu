<?php
namespace Team3\PropertyExtractor\Reader;

use Doctrine\Common\Annotations\AnnotationReader as DoctrineAnnotationReader;
use Psr\Log\LoggerInterface;

class AnnotationReaderTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @expectedException \Team3\PropertyExtractor\ExtractorException
     */
    public function testIfExceptionIsThrown()
    {
        $ar = new AnnotationReader(new DoctrineAnnotationReader(), $this->getLogger());

        $ar->read('not-object');
    }

    /**
     * @return LoggerInterface
     */
    private function getLogger()
    {
        return $this->getMock('Psr\Log\LoggerInterface');
    }
}
