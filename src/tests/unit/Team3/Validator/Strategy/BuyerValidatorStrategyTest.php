<?php
namespace Team3\Validator\Strategy;

use Team3\Order\Model\Order;
use Team3\Order\Model\OrderInterface;

/**
 * Class BuyerValidatorStrategyTest
 * @package Team3\Validator\Strategy
 * @group validator
 */
class BuyerValidatorStrategyTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var BuyerValidatorStrategy
     */
    protected $validator;

    /**
     * @var OrderInterface
     */
    protected $properOrder;

    protected function _before()
    {
        $this->validator = new BuyerValidatorStrategy();
        $this->properOrder = new Order();
        $this
            ->properOrder
            ->getBuyer()
            ->setFirstName('First name')
            ->setLastName('Last name')
            ->setEmail('test@test.pl');
    }

    public function testIfProperOrderWillPass()
    {
        $result = $this->validator->validate($this->properOrder);
        $this->assertTrue($result);
        $this->assertEmpty($this->validator->getValidationErrors());
    }

    public function testIfInvalidOrderWillNotPass()
    {
        $invalidOrder = new Order();
        $invalidOrder->getBuyer()->setFirstName('only first name');
        $result = $this->validator->validate($invalidOrder);
        $this->assertFalse($result);

        $errors = $this->validator->getValidationErrors();
        $this->assertNotEmpty($errors);
        $this->assertCount(2, $errors);
    }
}
