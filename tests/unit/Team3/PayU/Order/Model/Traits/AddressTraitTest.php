<?php
namespace Team3\PayU\Order\Traits;

use tests\unit\Team3\PayU\Order\Model\Traits\AddressTraitModel;

class AddressTraitTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testFilledMethod()
    {
        $address = new AddressTraitModel();

        $this->assertFalse($address->isFilled());

        $address->setStreet('t');
        $this->assertFalse($address->isFilled());

        $address->setCity('t');
        $this->assertFalse($address->isFilled());

        $address->setPostalCode('t');
        $this->assertFalse($address->isFilled());

        $address->setCountryCode('t');
        $this->assertTrue($address->isFilled());
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

        $address = new AddressTraitModel();

        $address->validate($executionContext);
        $this->assertEquals(0, $violations);
        $violations = 0;

        $address->setStreet('t');
        $address->validate($executionContext);
        $this->assertEquals(1, $violations);
        $violations = 0;

        $address->setCity('t');
        $address->validate($executionContext);
        $this->assertEquals(1, $violations);
        $violations = 0;

        $address->setPostalCode('t');
        $address->validate($executionContext);
        $this->assertEquals(1, $violations);
        $violations = 0;

        $address->setCountryCode('t');
        $address->validate($executionContext);
        $this->assertEquals(0, $violations);
    }
}
