<?php
namespace Team3\Order\Transformer\UserOrder\Strategy;

use Doctrine\Common\Annotations\AnnotationReader as DoctrineAnnotationReader;
use Team3\Order\Annotation\PayU;
use Team3\Order\PropertyExtractor\ExtractorResult;
use Team3\Order\PropertyExtractor\Reader\AnnotationReader;
use Team3\Order\Model\Order;
use Team3\Order\Model\OrderInterface;
use Team3\Order\PropertyExtractor\Extractor;
use Team3\Order\PropertyExtractor\ExtractorInterface;
use Team3\Order\Transformer\UserOrder\Strategy\General\GeneralTransformer;
use tests\unit\Team3\Order\Transformer\UserOrder\Strategy\Model\UserOrderModelWithPrivateMethods;

class GeneralTransformerTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var GeneralTransformer
     */
    protected $generalTransformer;

    /**
     * @var ExtractorInterface
     */
    protected $annotationsExtractor;

    /**
     * @inheritdoc
     */
    protected function _before()
    {
        // autoload payu annotation
        new PayU();

        $this->generalTransformer = new GeneralTransformer();
        $this->annotationsExtractor = new Extractor(new AnnotationReader(new DoctrineAnnotationReader()));
    }

    public function testIfIsImplementingStrategyInterface()
    {
        $this->assertInstanceOf(
            'Team3\Order\Transformer\UserOrder\Strategy\UserOrderTransformerStrategyInterface',
            $this->generalTransformer
        );
    }

    public function testIfSupportGeneralParameters()
    {
        $this->assertTrue(
            $this->generalTransformer->supports('general.something')
        );

        $this->assertFalse(
            $this->generalTransformer->supports('non-general.test')
        );
    }

    public function testIfIsCopingValues()
    {
        $order = new Order();
        $userOrder = new UserOrderModelWithPrivateMethods();

        $this->copyAllValues($order, $userOrder);

        $general = $order->getGeneral();
        $this->assertNotEmpty($general->getAdditionalDescription());
        $this->assertNotEmpty($general->getCurrencyCode());
        $this->assertNotEmpty($general->getCustomerIp());
        $this->assertNotEmpty($general->getDescription());
        $this->assertNotEmpty($general->getMerchantPosId());
        $this->assertNotEmpty($general->getOrderId());
        $this->assertNotEmpty($general->getSignature());
        $this->assertNotEmpty($general->getTotalAmount());
    }

    /**
     * @param OrderInterface                  $order
     * @param UserOrderModelWithPrivateMethods $userOrder
     */
    private function copyAllValues(
        OrderInterface $order,
        UserOrderModelWithPrivateMethods $userOrder
    ) {
        $results = $this
            ->annotationsExtractor
            ->extract($userOrder);

        /** @var ExtractorResult $result */
        foreach ($results as $result) {
            if ($this->generalTransformer->supports($result->getPropertyName())) {
                $this->generalTransformer->transform(
                    $order,
                    $result
                );
            }
        }
    }
}
