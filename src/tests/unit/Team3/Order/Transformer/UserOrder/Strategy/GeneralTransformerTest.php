<?php
namespace Team3\Order\Transformer\UserOrder\Strategy;

use Doctrine\Common\Annotations\AnnotationReader;
use Team3\Order\Annotation\Extractor\AnnotationsExtractor;
use Team3\Order\Annotation\Extractor\AnnotationsExtractorInterface;
use Team3\Order\Annotation\Extractor\AnnotationsExtractorResult;
use Team3\Order\Annotation\PayU;
use Team3\Order\Model\Order;
use Team3\Order\Model\OrderInterface;
use Team3\Order\Transformer\UserOrder\Strategy\General\GeneralTransformer;
use tests\unit\Team3\Order\Transformer\UserOrder\Strategy\UserOrderModelWithPrivateMethod;

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
     * @var AnnotationsExtractorInterface
     */
    protected $annotationsExtractor;

    /**
     * @inheritdoc
     */
    protected function _before()
    {
        $this->generalTransformer = new GeneralTransformer();
        $this->annotationsExtractor = new AnnotationsExtractor(new AnnotationReader());
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
        $payu = new PayU();

        $payu->propertyName = 'general.something';
        $this->assertTrue(
            $this->generalTransformer->supports($payu)
        );

        $payu->propertyName = 'non-general.test';
        $this->assertFalse(
            $this->generalTransformer->supports($payu)
        );
    }

    public function testIfIsCopingValues()
    {
        $order = new Order();
        $userOrder = new UserOrderModelWithPrivateMethod();

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
     * @param UserOrderModelWithPrivateMethod $userOrder
     */
    private function copyAllValues(
        OrderInterface $order,
        UserOrderModelWithPrivateMethod $userOrder
    ) {
        $results = $this
            ->annotationsExtractor
            ->extract($userOrder);

        /** @var AnnotationsExtractorResult $result */
        foreach ($results as $result) {
            if ($this->generalTransformer->supports($result->getAnnotation())) {
                $this->generalTransformer->transform(
                    $order,
                    $userOrder,
                    $result
                );
            }
        }
    }
}
