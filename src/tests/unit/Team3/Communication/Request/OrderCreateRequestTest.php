<?php
namespace Team3\Communication\Request;

class OrderCreateRequestTest extends \Codeception\TestCase\Test
{
    const DATA = 'data';
    const PATH = '/orders';

    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testParameters()
    {
        $request = new OrderCreateRequest(self::DATA);

        $this->assertEquals(
            self::DATA,
            $request->getData()
        );

        $this->assertEquals(
            self::PATH,
            $request->getPath()
        );
    }
}
