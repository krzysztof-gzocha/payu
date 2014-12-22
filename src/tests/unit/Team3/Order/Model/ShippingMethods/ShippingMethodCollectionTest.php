<?php
namespace Team3\Order\Model\ShippingMethods;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Validator\Constraints\Country;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Team3\Order\Model\Money\Money;
use Team3\ValidatorBuilder\ValidatorBuilder;

class ShippingMethodCollectionTest extends \Codeception\TestCase\Test
{
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
        $this->load();
        $this->validator = (new ValidatorBuilder())->getValidator(new AnnotationReader());
    }

    public function testValidationConfiguration()
    {
        $smc = new ShippingMethodCollection([
            (new ShippingMethod())->setPrice(new Money(-1)),
        ]);
        $this->assertCount(3, $this->validator->validate($smc));
    }

    public function testCountMethod()
    {
        $smc = new ShippingMethodCollection();
        $this->assertCount(
            0,
            $smc->getShippingMethods()
        );
        $smc->setShippingMethods([1, 2, 3]);
        $this->assertCount(
            3,
            $smc->getShippingMethods()
        );
        $this->assertEquals(
            3,
            $smc->count()
        );
        $this->assertEquals(
            3,
            count($smc)
        );
    }

    public function testIterator()
    {
        $smc = new ShippingMethodCollection();
        $this->assertInstanceOf(
            '\Iterator',
            $smc->getIterator()
        );
    }

    public function testIfIsFilled()
    {
        $smc = new ShippingMethodCollection([1, 2]);
        $this->assertTrue($smc->isFilled());
    }

    private function load()
    {
        new Valid();
        new Country();
        new NotNull();
    }
}
