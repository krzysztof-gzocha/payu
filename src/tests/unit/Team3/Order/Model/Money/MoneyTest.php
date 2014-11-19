<?php
namespace Team3\Order\Model\Money;


class MoneyTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testIfThrowsExceptionWhenArrayGiven()
    {
        $this->setExpectedException(WrongMoneyValueException::class);
        $this->assertInstanceOf(
            'Team3\Order\Model\Money\MoneyInterface',
            new Money([])
        );
    }

    public function testIfThrowsExceptionWhenObjectGiven()
    {
        $this->setExpectedException(WrongMoneyValueException::class);
        $this->assertInstanceOf(
            'Team3\Order\Model\Money\MoneyInterface',
            new Money(new \stdClass())
        );
    }

    public function testIfThrowsExceptionWhenNullGiven()
    {
        $this->setExpectedException(WrongMoneyValueException::class);
        $this->assertInstanceOf(
            'Team3\Order\Model\Money\MoneyInterface',
            new Money(null)
        );
    }
}
