<?php
namespace Team3\Order\Transformer\UserOrder\Strategy\ShippingMethod;

use Team3\Order\Model\Order;
use Team3\Order\Model\OrderInterface;
use Team3\PropertyExtractor\Extractor;
use Team3\PropertyExtractor\Reader\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationReader as DoctrineAnnotationReader;
use tests\unit\Team3\Order\Transformer\UserOrder\Strategy\Model\UserOrderModelWithPrivateMethods;

class ShippingMethodCollectionTransformerTest extends \Codeception\TestCase\Test
{
    /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var Extractor
     */
    protected $extractor;

    /**
     * @var ShippingMethodCollectionTransformer
     */
    protected $shippingMethodCollectionTransformer;

    protected function _before()
    {
        $this->extractor = new Extractor(
            new AnnotationReader(
                new DoctrineAnnotationReader()
            )
        );

        $this->shippingMethodCollectionTransformer = new ShippingMethodCollectionTransformer(
            new SingleShippingMethodTransformer($this->extractor)
        );
    }

    public function testIfSupportsOnlyCertainPropertyName()
    {
        $this->assertTrue(
            $this->shippingMethodCollectionTransformer->supports('shippingMethodCollection')
        );
        $this->assertFalse(
            $this->shippingMethodCollectionTransformer->supports('non-shippingMethodCollection')
        );
    }

    public function testResultsOnRealExample()
    {
        $order = new Order();
        $usersOrder = new UserOrderModelWithPrivateMethods();

        $this->copyAllValues($order, $usersOrder);
        $shippingMethodCollection = $order->getShippingMethodCollection();
        $this->assertCount(1, $shippingMethodCollection);
        $shippingMethod = $shippingMethodCollection->getShippingMethods()[0];
        $this->assertNotEmpty($shippingMethod->getCountry());
        $this->assertNotEmpty($shippingMethod->getPrice());
        $this->assertNotEmpty($shippingMethod->getName());
    }

    /**
     * @expectedException Team3\PropertyExtractor\ExtractorException
     */
    public function testIfExceptionIsThrown()
    {
        $order = new Order();
        $userOrder = new UserOrderModelWithPrivateMethods();
        $userOrder->clearShippingMethodCollection();

        $this->copyAllValues($order, $userOrder);
    }

    /**
     * @param OrderInterface                   $order
     * @param UserOrderModelWithPrivateMethods $userOrder
     */
    protected function copyAllValues(
        OrderInterface $order,
        UserOrderModelWithPrivateMethods $userOrder
    ) {
        foreach ($this->extractor->extract($userOrder) as $extractedResult) {
            if ($this->shippingMethodCollectionTransformer
                ->supports(
                    $extractedResult->getPropertyName()
                )
            ) {
                $this
                    ->shippingMethodCollectionTransformer
                    ->transform($order, $extractedResult);
            }
        }
    }
}
