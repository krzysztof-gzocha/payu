<?php
namespace Team3\PayU\Order\Transformer\UserOrder\Strategy;

use Team3\PayU\Order\Model\Order;
use Team3\PayU\Order\Model\OrderInterface;
use Team3\PayU\PropertyExtractor\Extractor;
use Team3\PayU\PropertyExtractor\ExtractorInterface;
use Team3\PayU\PropertyExtractor\ExtractorResult;
use Team3\PayU\PropertyExtractor\Reader\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationReader as DoctrineAnnotationReader;
use tests\unit\Team3\PayU\Order\Transformer\UserOrder\Strategy\Model\DeliveryModelWithPrivateMethods;

class DeliveryTransformerTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var ExtractorInterface
     */
    protected $extractor;

    /**
     * @var DeliveryTransformer
     */
    protected $deliveryTransformer;

    protected function _before()
    {
        $this->extractor = new Extractor(
            new AnnotationReader(
                new DoctrineAnnotationReader(),
                $this->getLogger()
            ),
            $this->getLogger()
        );

        $this->deliveryTransformer = new DeliveryTransformer();
    }

    public function testIfImplementsStrategyInterface()
    {
        $this->assertInstanceOf(
            'Team3\PayU\Order\Transformer\UserOrder\Strategy\UserOrderTransformerStrategyInterface',
            $this->deliveryTransformer
        );
    }

    public function testIfSupportsOnlyCertainPropertyName()
    {
        $this->assertFalse(
            $this->deliveryTransformer->supports('delivery.')
        );
        $this->assertFalse(
            $this->deliveryTransformer->supports('non-delivery.test')
        );
        $this->assertTrue(
            $this->deliveryTransformer->supports('delivery.test')
        );
    }

    public function testIfAllValuesAreCopied()
    {
        $order = new Order();
        $deliveryModel = new DeliveryModelWithPrivateMethods();

        $this->copyAllValues($order, $deliveryModel);
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
     * @param OrderInterface                  $order
     * @param DeliveryModelWithPrivateMethods $delivery
     */
    private function copyAllValues(
        OrderInterface $order,
        DeliveryModelWithPrivateMethods $delivery
    ) {
        $results = $this
            ->extractor
            ->extract($delivery);

        /** @var ExtractorResult $result */
        foreach ($results as $result) {
            if ($this->deliveryTransformer->supports($result->getPropertyName())) {
                $this->deliveryTransformer->transform(
                    $order,
                    $result
                );
            }
        }
    }

    /**
     * @return \Psr\Log\LoggerInterface
     */
    private function getLogger()
    {
        return $this->getMock('Psr\Log\LoggerInterface');
    }
}
