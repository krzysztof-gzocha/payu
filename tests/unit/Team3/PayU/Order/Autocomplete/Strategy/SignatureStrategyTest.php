<?php
namespace Team3\PayU\Order\Autocomplete\Strategy;

use Team3\PayU\Configuration\Configuration;
use Team3\PayU\Configuration\Credentials\TestCredentials;
use Team3\PayU\Order\Autocomplete\OrderAutocompleteException;
use Team3\PayU\Order\Model\Order;
use Team3\PayU\SignatureCalculator\SignatureCalculatorException;
use Team3\PayU\SignatureCalculator\OrderSignatureCalculatorInterface;

class SignatureStrategyTest extends \Codeception\TestCase\Test
{
    const SIGNATURE = 'calculated signature';
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testAutocomplete()
    {
        $signature = new SignatureStrategy($this->getSignatureCalculator());
        $signature->autocomplete($order = new Order(), new Configuration(new TestCredentials()));

        $this->assertEquals(
            self::SIGNATURE,
            $order->getSignature()
        );
    }

    public function testSupports()
    {
        $signature = new SignatureStrategy($this->getSignatureCalculator());

        $this->assertTrue($signature->supports($order = new Order()));
        $order->setSignature(self::SIGNATURE);
        $this->assertFalse($signature->supports($order));
    }

    /**
     * @expectedException \Team3\PayU\Order\Autocomplete\OrderAutocompleteException
     */
    public function testCalculatorException()
    {
        $calculator = $this
            ->getMockBuilder('\Team3\PayU\SignatureCalculator\OrderSignatureCalculator')
            ->disableOriginalConstructor()
            ->getMock();

        $calculator
            ->expects($this->any())
            ->method('calculate')
            ->withAnyParameters()
            ->willThrowException(new SignatureCalculatorException());

        $signature = new SignatureStrategy($calculator);
        $signature->autocomplete(new Order(), new Configuration(new TestCredentials()));
    }

    /**
     * @return OrderSignatureCalculatorInterface
     */
    private function getSignatureCalculator()
    {
        $calculator = $this
            ->getMockBuilder('\Team3\PayU\SignatureCalculator\OrderSignatureCalculator')
            ->disableOriginalConstructor()
            ->getMock();

        $calculator
            ->expects($this->any())
            ->method('calculate')
            ->withAnyParameters()
            ->willReturn(self::SIGNATURE);

        return $calculator;
    }
}
