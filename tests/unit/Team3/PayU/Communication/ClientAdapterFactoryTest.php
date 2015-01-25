<?php
namespace Team3\PayU\Communication;

use Psr\Log\LoggerInterface;
use Team3\PayU\Serializer\SerializerInterface;

/**
 * Class ClientAdapterFactoryTest
 * @package Team3\PayU\Communication
 * @group communication
 */
class ClientAdapterFactoryTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testResult()
    {
        $factory = new ClientAdapterFactory();

        $this->assertInstanceOf(
            'Team3\PayU\Communication\ClientAdapter',
            $factory->build(
                $this->getSerializer(),
                $this->getLogger()
            )
        );
    }

    /**
     * @return SerializerInterface
     */
    private function getSerializer()
    {
        return $this->getMock('Team3\PayU\Serializer\SerializerInterface');
    }

    /**
     * @return LoggerInterface
     */
    private function getLogger()
    {
        return $this->getMock('Psr\Log\LoggerInterface');
    }
}
