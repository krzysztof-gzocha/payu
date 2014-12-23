<?php
namespace Team3\Order\Model\Buyer;

class BuyerTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testIsFilledMethod()
    {
        $buyer = new Buyer();
        $this->assertFalse($buyer->isFilled());
        $buyer->setEmail('t');
        $this->assertFalse($buyer->isFilled());
        $buyer->setFirstName('t');
        $this->assertFalse($buyer->isFilled());
        $buyer->setLastName('t');
        $this->assertTrue($buyer->isFilled());
    }

    public function testValidateMethod()
    {
        $violations = 0;
        $executionContext = $this
            ->getMockBuilder('\Symfony\Component\Validator\Context\ExecutionContextInterface')
            ->getMock();

        $violationBuilder = $this
            ->getMockBuilder('\Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface')
            ->getMock();

        $violationBuilder
            ->expects($this->any())
            ->method('addViolation')
            ->willReturnCallback(function () use (&$violations) {
                $violations += 1;
            });

        $executionContext
            ->expects($this->any())
            ->method('buildViolation')
            ->willReturn($violationBuilder);

        $buyer = new Buyer();
        $buyer->validate($executionContext);
        $this->assertEquals(0, $violations);
        $violations = 0;

        $buyer->setEmail('t');
        $buyer->validate($executionContext);
        $this->assertEquals(1, $violations);
        $violations = 0;

        $buyer->setFirstName('t');
        $buyer->validate($executionContext);
        $this->assertEquals(1, $violations);
        $violations = 0;

        $buyer->setLastName('t');
        $buyer->validate($executionContext);
        $this->assertEquals(0, $violations);
    }
}
