<?php
namespace Team3\Validator\Strategy;

use Team3\Order\Model\Order;

/**
 * Class DeliveryValidatorStrategyTest
 * @package Team3\Validator\Strategy
 * @group validator
 */
class DeliveryValidatorStrategyTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testIfValidOrderWillPass()
    {
        $validator = new DeliveryValidatorStrategy();

        $result = $validator->validate($this->getValidOrder());
        $this->assertTrue($result);
    }

    public function testIfInvalidOrderWillNotPass()
    {
        $validator = new DeliveryValidatorStrategy();

        $result = $validator->validate($this->getInvalidOrder());
        $this->assertFalse($result);
        $this->assertCount(4, $validator->getValidationErrors(), print_r($validator->getValidationErrors(), true));
    }

    public function testIfOrderWithoutInformationWillNotBeValidated()
    {
        $validator = new DeliveryValidatorStrategy();

        $result = $validator->validate(new Order());
        $this->assertTrue($result);
    }

    /**
     * @return Order
     */
    private function getValidOrder()
    {
        $order = new Order();

        $order
            ->getBuyer()
            ->getDelivery()
            ->setPostalCode('postal code')
            ->setStreet('Some street')
            ->setCountryCode('CC')
            ->setCity('City');

        return $order;
    }

    /**
     * @return Order
     */
    private function getInvalidOrder()
    {
        $order = new Order();
        $order
            ->getBuyer()
            ->getDelivery()
            ->setCity('')
            ->setCountryCode('abc')
            ->setPostalCode('')
            ->setStreet('');

        return $order;
    }
}
