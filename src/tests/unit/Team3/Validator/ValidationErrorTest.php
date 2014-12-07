<?php
namespace Team3\Validator;

/**
 * Class ValidationErrorTest
 * @package Team3\Validator
 * @group validator
 */
class ValidationErrorTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testGetters()
    {
        $error = new ValidationError(new \stdClass(), 'Message', 'property');

        $this->assertInstanceOf(
            '\stdClass',
            $error->getObject()
        );

        $this->assertEquals(
            'Message',
            $error->getMessage()
        );

        $this->assertEquals(
            'property',
            $error->getParameter()
        );
    }
}
