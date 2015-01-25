<?php
namespace Team3\PayU\Serializer;

class SerializerFactoryTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testResult()
    {
        $factory = new SerializerFactory();

        $this->assertInstanceOf(
            'Team3\PayU\Serializer\SerializerInterface',
            $factory->build($this->getLogger())
        );
    }

    private function getLogger()
    {
        return $this->getMock('Psr\Log\LoggerInterface');
    }
}
