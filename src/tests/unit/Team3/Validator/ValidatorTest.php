<?php
namespace Team3\Validator;

use Team3\Order\Model\Order;
use Team3\Order\Model\OrderInterface;

/**
 * Class ValidatorTest
 * @package Team3\Validator
 * @group validator
 */
class ValidatorTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var ValidatorInterface
     */
    protected $strategy;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var OrderInterface
     */
    protected $order;

    protected function _before()
    {
        $this->order = new Order();
        $this->strategy = $this
            ->getMockBuilder('Team3\Validator\ValidatorInterface')
            ->getMock();
        $this
            ->strategy
            ->expects($this->any())
            ->method('validate')
            ->willReturn(false);

        $validationError = $this
            ->getMockBuilder('Team3\Validator\ValidationErrorInterface')
            ->getMock();
        $this
            ->strategy
            ->expects($this->any())
            ->method('getValidationErrors')
            ->willReturn([$validationError]);

        $this->validator = new Validator();
    }

    public function testIfStrategiesErrorArePropagated()
    {
        $this->validator->addValidatorStrategy($this->strategy);
        $result = $this->validator->validate($this->order);
        $this->assertFalse($result);

        $errors = $this->validator->getValidationErrors();
        $this->assertNotEmpty($errors);
        $this->assertCount(1, $errors);

        foreach ($errors as $error) {
            $this->assertInstanceOf(
                'Team3\Validator\ValidationErrorInterface',
                $error
            );
        }
    }
}
