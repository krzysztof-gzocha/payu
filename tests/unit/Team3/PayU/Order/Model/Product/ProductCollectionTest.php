<?php
namespace Team3\PayU\Order\Model\Product;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Team3\PayU\Order\Model\Products\Product;
use Team3\PayU\Order\Model\Products\ProductCollection;
use Team3\PayU\ValidatorBuilder\ValidatorBuilder;

class ProductCollectionTest extends \Codeception\TestCase\Test
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
        $this->validator = (new ValidatorBuilder())->getValidator(new AnnotationReader());
    }

    public function testValidationConfiguration()
    {
        $valid = $this->validator->validate(new ProductCollection([]));
        $this->assertCount(1, $valid);

        $productCollectionWithWrongProduct = new ProductCollection([
            new Product(),
        ]);
        $this->assertCount(3, $this->validator->validate($productCollectionWithWrongProduct));
    }

    public function testIsFilled()
    {
        $pc = new ProductCollection();

        $this->assertFalse($pc->isFilled());
        $pc->setProducts([1, 2, 3]);
        $this->assertTrue($pc->isFilled());
    }

    public function testSetProducts()
    {
        $productCollection = new ProductCollection();
        $productCollection->setProducts(['123' => '456']);

        $this->assertEquals(
            '456',
            $productCollection->getProducts()[0]
        );
    }

    public function testCount()
    {
        $productCollection = new ProductCollection(['1', '2', '3']);

        $this->assertEquals(
            '3',
            $productCollection->count()
        );
        $this->assertEquals(
            '3',
            count($productCollection)
        );
    }

    public function testIterator()
    {
        $productCollection = new ProductCollection();

        $this->assertInstanceOf(
            '\Iterator',
            $productCollection->getIterator()
        );
    }
}
