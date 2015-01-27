<?php
namespace Team3\PayU\PropertyExtractor;

use Psr\Log\LoggerInterface;

class PropertyExtractorFactoryTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testResult()
    {
        $factory = new PropertyExtractorFactory();

        $this->assertInstanceOf(
            '\Team3\PayU\PropertyExtractor\ExtractorInterface',
            $factory->build($this->getLogger())
        );
    }

    /**
     * @return LoggerInterface
     */
    private function getLogger()
    {
        return $this
            ->getMock('Psr\Log\LoggerInterface');
    }
}
