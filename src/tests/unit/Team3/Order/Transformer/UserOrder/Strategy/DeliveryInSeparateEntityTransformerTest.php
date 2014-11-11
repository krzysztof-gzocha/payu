<?php
namespace Team3\Order\Transformer\UserOrder\Strategy;

use Team3\Order\Annotation\PayU;
use Team3\Order\Model\Order;
use Team3\Order\Model\OrderInterface;
use Team3\Order\PropertyExtractor\Extractor;
use Team3\Order\PropertyExtractor\ExtractorInterface;
use Team3\Order\PropertyExtractor\ExtractorResult;
use Team3\Order\PropertyExtractor\Reader\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationReader as DoctrineAnnotationReader;
use Team3\Order\Transformer\UserOrder\UserOrderTransformer;
use Team3\Order\Transformer\UserOrder\UserOrderTransformerInterface;
use tests\unit\Team3\Order\Transformer\UserOrder\Strategy\Model\UserOrderModelWithPrivateMethods;

class DeliveryInSeparateEntityTransformerTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var UserOrderTransformerInterface
     */
    protected $transformer;

    /**
     * @var BuyerInSeparateEntityTransformer
     */
    protected $deliveryInSeparateEntityTransformer;

    /**
     * @var ExtractorInterface
     */
    protected $extractor;

    protected function _before()
    {
        //autoload payu annotation
        new PayU();

        $this->extractor = new Extractor(
            new AnnotationReader(
                new DoctrineAnnotationReader()
            )
        );

        $this->transformer = new UserOrderTransformer(
            $this->extractor
        );

        $this->transformer->addStrategy(new DeliveryTransformer());

        $this->deliveryInSeparateEntityTransformer = new DeliveryInSeparateEntityTransformer();
        $this->deliveryInSeparateEntityTransformer->setMainTransformer($this->transformer);
    }

    public function testIfSupportsOnlyCertainPropertyName()
    {
        $this->assertTrue(
            $this->deliveryInSeparateEntityTransformer->supports('delivery')
        );
        $this->assertFalse(
            $this->deliveryInSeparateEntityTransformer->supports('non-delivery')
        );
        $this->assertFalse(
            $this->deliveryInSeparateEntityTransformer->supports('delivery.test')
        );
    }

    public function testResultsFromSeparateEntity()
    {
        $order = new Order();
        $userOrder = new UserOrderModelWithPrivateMethods();

        $this->copyAllValues($order, $userOrder);
        $delivery = $order->getBuyer()->getDelivery();
        $this->assertNotEmpty($delivery->getStreet());
        $this->assertNotEmpty($delivery->getRecipientName());
        $this->assertNotEmpty($delivery->getRecipientEmail());
        $this->assertNotEmpty($delivery->getName());
        $this->assertNotEmpty($delivery->getCity());
        $this->assertNotEmpty($delivery->getCountryCode());
        $this->assertNotEmpty($delivery->getPostalCode());
        $this->assertNotEmpty($delivery->getRecipientPhone());
    }

    /**
     * @param OrderInterface                   $order
     * @param UserOrderModelWithPrivateMethods $userOrder
     */
    private function copyAllValues(
        OrderInterface $order,
        UserOrderModelWithPrivateMethods $userOrder
    ) {
        $results = $this
            ->extractor
            ->extract($userOrder);

        /** @var ExtractorResult $result */
        foreach ($results as $result) {
            if ($this->deliveryInSeparateEntityTransformer->supports($result->getPropertyName())) {
                $this->deliveryInSeparateEntityTransformer->transform(
                    $order,
                    $result
                );
            }
        }
    }
}
