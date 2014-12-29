<?php
namespace Team3\Order\Transformer\UserOrder\Strategy;

use Doctrine\Common\Annotations\AnnotationReader as DoctrineAnnotationReader;
use Team3\Annotation\PayU;
use Team3\PropertyExtractor\ExtractorResult;
use Team3\PropertyExtractor\Reader\AnnotationReader;
use Team3\Order\Model\Order;
use Team3\Order\Model\OrderInterface;
use Team3\PropertyExtractor\Extractor;
use Team3\PropertyExtractor\ExtractorInterface;
use tests\unit\Team3\Order\Transformer\UserOrder\Strategy\Model\UserOrderModelWithPrivateMethods;

/**
 * Class GeneralTransformerTest
 * @package Team3\Order\Transformer\UserOrder\Strategy
 * @group money
 */
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
        $this->annotationsExtractor = new Extractor(
            new AnnotationReader(
                new DoctrineAnnotationReader(),
                $this->getLogger()
            ),
            $this->getLogger()
        );
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

        $this->assertNotEmpty($order->getAdditionalDescription());
        $this->assertNotEmpty($order->getCurrencyCode());
        $this->assertNotEmpty($order->getCustomerIp());
        $this->assertNotEmpty($order->getDescription());
        $this->assertNotEmpty($order->getMerchantPosId());
        $this->assertNotEmpty($order->getOrderId());
        $this->assertNotEmpty($order->getSignature());
        $this->assertNotEmpty($order->getTotalAmount());
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

    /**
     * @return \Psr\Log\LoggerInterface
     */
    private function getLogger()
    {
        return $this->getMock('Psr\Log\LoggerInterface');
    }
}
