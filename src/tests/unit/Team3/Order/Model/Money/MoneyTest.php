<?php
namespace Team3\Order\Model\Money;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Team3\ValidatorBuilder\ValidatorBuilder;

/**
 * Class MoneyTest
 * @package Team3\Order\Model\Money
 * @group money
 */
class MoneyTest extends \Codeception\TestCase\Test
{
    const WRONG_MONEY_EXCEPTION_CLASS = '\Team3\Order\Model\Money\WrongMoneyValueException';

    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    protected function _before()
    {
        new GreaterThan();
        new Length(["min" => 1]);
        $this->validator = (new ValidatorBuilder())->getValidator(new AnnotationReader());
    }

    public function testValidationConfiguration()
    {
        $valid = $this->validator->validate(new Money(-1, 'notCurrencyCode', 0));
        $this->assertCount(3, $valid);
    }

    public function testToStringMethodWithoutCurrency()
    {
        $money = new Money(12.3456, null, 3);
        $this->assertEquals(
            '12.346',
            (string) $money
        );
    }

    public function testToStringMethodWithCurrency()
    {
        $money = new Money(12.3456, 'EUR');
        $this->assertEquals(
            '12.35 EUR',
            (string) $money
        );
    }

    public function testIfValueWithoutSeparationIsCorrect()
    {
        $this->assertEquals(
            1234,
            (new Money(12.3456789))->getValueWithoutSeparation()
        );
        $this->assertEquals(
            1234,
            (new Money(12.3456789))->getValueWithoutSeparation(2)
        );
        $this->assertEquals(
            12345,
            (new Money(12.345))->getValueWithoutSeparation(3)
        );
        $this->assertEquals(
            100,
            (new Money(1))->getValueWithoutSeparation()
        );
        $this->assertEquals(
            0,
            (new Money(0))->getValueWithoutSeparation()
        );
        $this->assertEquals(
            -1234,
            (new Money(-12.34))->getValueWithoutSeparation()
        );
    }

    public function testIfThrowsExceptionWhenArrayGiven()
    {
        $this->setExpectedException(self::WRONG_MONEY_EXCEPTION_CLASS);
        $this->assertInstanceOf(
            'Team3\Order\Model\Money\MoneyInterface',
            new Money([])
        );
    }

    public function testIfThrowsExceptionWhenObjectGiven()
    {
        $this->setExpectedException(self::WRONG_MONEY_EXCEPTION_CLASS);
        $this->assertInstanceOf(
            'Team3\Order\Model\Money\MoneyInterface',
            new Money(new \stdClass())
        );
    }

    public function testIfThrowsExceptionWhenNullGiven()
    {
        $this->setExpectedException(self::WRONG_MONEY_EXCEPTION_CLASS);
        $this->assertInstanceOf(
            'Team3\Order\Model\Money\MoneyInterface',
            new Money(null)
        );
    }
}
