<?php
namespace Team3\Communication\Process;

use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;

/**
 * Class InvalidRequestDataObjectExceptionTest
 * @package Team3\Communication\Process
 * @group communication
 */
class InvalidRequestDataObjectExceptionTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testIfViolationsAreInException()
    {
        $violation = new ConstraintViolation('', '', [], '', '', '');
        $violationList = new ConstraintViolationList([$violation]);

        $exception = new InvalidRequestDataObjectException($violationList, 'Message');

        $this->assertInstanceOf(
            '\Symfony\Component\Validator\ConstraintViolationList',
            $exception->getViolations()
        );

        $this->assertCount(
            1,
            $exception->getViolations()
        );
    }
}
