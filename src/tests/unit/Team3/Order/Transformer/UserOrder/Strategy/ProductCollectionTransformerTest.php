<?php
namespace Team3\Order\Transformer\UserOrder\Strategy;


use Doctrine\Common\Annotations\AnnotationReader;
use Team3\Order\Annotation\Extractor\AnnotationsExtractor;
use Team3\Order\Annotation\PayU;
use Team3\Order\Model\Order;
use Team3\Order\Model\Products\ProductInterface;
use Team3\Order\Transformer\UserOrder\Strategy\Product\ProductCollectionTransformer;
use Team3\Order\Transformer\UserOrder\Strategy\Product\SingleProductTransformer;
use tests\unit\Team3\Order\Transformer\UserOrder\Strategy\ProductModel;
use tests\unit\Team3\Order\Transformer\UserOrder\Strategy\UserOrderModelWithPrivateMethod;
use tests\unit\Team3\Order\Transformer\UserOrder\Strategy\UsersProductCollectionModel;

class ProductCollectionTransformerTest extends \Codeception\TestCase\Test
{
    const PRODUCT_NAME = 'product name';
    const SINGLE_PRODUCT_QUANTITY = 10;
    const SINGLE_PRODUCT_PRICE = 12.34;
    const PRODUCTS_COUNT = 3;

    /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var ProductCollectionTransformer
     */
    private $productCollectionTransformer;

    /**
     * @inheritdoc
     */
    protected function _before()
    {
        $this->productCollectionTransformer = new ProductCollectionTransformer(
            new SingleProductTransformer(
                new AnnotationsExtractor(
                    new AnnotationReader()
                )
            )
        );
    }

    public function testSupportsMethod()
    {
        $payUAnnotation = new PayU();

        $payUAnnotation->propertyName = 'wrong property name';
        $this->assertFalse(
            $this->productCollectionTransformer->supports($payUAnnotation)
        );

        $payUAnnotation->propertyName = ProductCollectionTransformer::PARAMETER_NAME;
        $this->assertTrue(
            $this->productCollectionTransformer->supports($payUAnnotation)
        );
    }

    public function testResultsFromArray()
    {
        $this->testResults($this->getUserModel(array_fill(
            0,
            self::PRODUCTS_COUNT,
            $this->getUserProductModel()
        )));
    }

    public function testResultsFromTraversable()
    {
        $userProductCollection = new UsersProductCollectionModel();
        for ($i=0; $i<self::PRODUCTS_COUNT; $i++) {
            $userProductCollection->append($this->getUserProductModel());
        }

        $this->testResults($this->getUserModel(
            $userProductCollection
        ));
    }

    public function testExceptionWhenWrongProductCollectionTypeIsReturned()
    {
        $this
            ->assertExceptionWhenProductsAreNotTraversable(null)
            ->assertExceptionWhenProductsAreNotTraversable(123)
            ->assertExceptionWhenProductsAreNotTraversable(123.45)
            ->assertExceptionWhenProductsAreNotTraversable('test')
            ->assertExceptionWhenProductsAreNotTraversable($this->getUserProductModel());
    }

    /**
     * @param $wrongProducts
     *
     * @return $this
     */
    private function assertExceptionWhenProductsAreNotTraversable(
        $wrongProducts
    ) {
        $this->setExpectedException('Team3\Order\Transformer\UserOrder\UserOrderTransformerException');
        $userOrder = $this->getUserModel($wrongProducts);
        $userOrderReflection = new \ReflectionClass($userOrder);

        $this->productCollectionTransformer->transform(
            new Order(),
            $userOrder,
            $userOrderReflection->getMethod('getProducts')
        );

        return $this;
    }

    /**
     * @param UserOrderModelWithPrivateMethod $userOrder
     */
    private function testResults(UserOrderModelWithPrivateMethod $userOrder)
    {
        $order = new Order();
        $userOrderReflection = new \ReflectionClass($userOrder);

        $this->productCollectionTransformer->transform(
            $order,
            $userOrder,
            $userOrderReflection->getMethod('getProducts')
        );

        $this->assertCount(
            self::PRODUCTS_COUNT,
            $order->getProductCollection()->getProducts()
        );

        foreach ($order->getProductCollection()->getProducts() as $product) {
            $this->assertSingleProduct($product);
        }
    }

    /**
     * @param ProductInterface $product
     */
    private function assertSingleProduct($product)
    {
        $this->assertInstanceOf(
            'Team3\Order\Model\Products\ProductInterface',
            $product
        );

        $this->assertEquals(
            self::PRODUCT_NAME,
            $product->getName()
        );

        $this->assertEquals(
            self::SINGLE_PRODUCT_QUANTITY,
            $product->getQuantity()
        );

        $this->assertEquals(
            self::SINGLE_PRODUCT_PRICE,
            $product->getUnitPrice()
        );
    }

    /**
     * @param $products
     *
     * @return UserOrderModelWithPrivateMethod
     */
    private function getUserModel($products)
    {
        return new UserOrderModelWithPrivateMethod($products);
    }

    /**
     * @return ProductModel
     */
    private function getUserProductModel()
    {
        return new ProductModel(
            self::PRODUCT_NAME,
            self::SINGLE_PRODUCT_QUANTITY,
            self::SINGLE_PRODUCT_PRICE
        );
    }
}
