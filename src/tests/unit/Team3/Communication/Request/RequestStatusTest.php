<?php
namespace Team3\Communication\Request;

class RequestStatusTest extends \Codeception\TestCase\Test
{
    const CODE = '123';
    const DESCRIPTION = 'description';
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testParameters()
    {
        $status = new RequestStatus();

        $status->setCode(self::CODE);
        $status->setDescription(self::DESCRIPTION);

        $this->assertEquals(
            self::CODE,
            $status->getCode()
        );
        $this->assertEquals(
            self::DESCRIPTION,
            $status->getDescription()
        );
        $this->assertFalse($status->isSuccess());
        $status->setCode(RequestStatus::STATUS_SUCCESS);
        $this->assertTrue($status->isSuccess());
    }
}
