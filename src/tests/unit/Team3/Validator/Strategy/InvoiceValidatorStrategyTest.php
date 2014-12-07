<?php
namespace Team3\Validator\Strategy;


use Team3\Order\Model\Order;
use Team3\Order\Model\OrderInterface;

/**
 * Class InvoiceValidatorStrategyTest
 * @package Team3\Validator\Strategy
 * @group validator
 */
class InvoiceValidatorStrategyTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var OrderInterface
     */
    protected $validOrder;

    /**
     * @var InvoiceValidatorStrategy
     */
    protected $validator;

    protected function _before()
    {
        $this->validOrder = new Order();
        $this->validOrder->getBuyer()->getInvoice()
            ->setCity('Some city')
            ->setCountryCode('country code')
            ->setPostalCode('postal-code')
            ->setStreet('Some street');

        $this->validator = new InvoiceValidatorStrategy();
    }

    public function testIfValidOrderWillPass()
    {
        $result = $this->validator->validate($this->validOrder);
        $this->assertTrue($result);
        $this->assertEmpty($this->validator->getValidationErrors());
    }

    public function testIfEmptyOrderWillPass()
    {
        $result = $this->validator->validate(new Order());
        $this->assertTrue($result);
        $this->assertEmpty($this->validator->getValidationErrors());
    }

    public function testIfInvalidValuesWillCauseErrors()
    {
        $invalidOrder = new Order();
        $invalidOrder
            ->getBuyer()
            ->getInvoice()
            ->setStreet('only street');

        $result = $this->validator->validate($invalidOrder);
        $this->assertFalse($result);
        $this->assertCount(3, $this->validator->getValidationErrors());

        $invalidOrder
            ->getBuyer()
            ->getInvoice()
            ->setStreet('')
            ->setPostalCode('some postal');

        $validator = new InvoiceValidatorStrategy();
        $result = $validator->validate($invalidOrder);
        $this->assertFalse($result);
        $this->assertCount(3, $validator->getValidationErrors());
    }
}
