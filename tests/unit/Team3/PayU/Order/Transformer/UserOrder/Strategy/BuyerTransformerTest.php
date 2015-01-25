<?php
namespace Team3\PayU\Order\Transformer\UserOrder\Strategy;

use Doctrine\Common\Annotations\AnnotationReader as DoctrineAnnotationReader;
use Team3\PayU\Order\Model\Order;
use Team3\PayU\Order\Model\OrderInterface;
use Team3\PayU\PropertyExtractor\Extractor;
use Team3\PayU\PropertyExtractor\ExtractorResult;
use Team3\PayU\PropertyExtractor\Reader\AnnotationReader;
use tests\unit\Team3\PayU\Order\Transformer\UserOrder\Strategy\Model\BuyerModelWithPrivateMethods;

class BuyerTransformerTest extends \Codeception\TestCase\Test
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
     * @var BuyerTransformer
     */
    protected $buyerTransformer;

    protected function _before()
    {
        $this->extractor = new Extractor(
            new AnnotationReader(
                new DoctrineAnnotationReader(),
                $this->getLogger()
            ),
            $this->getLogger()
        );
        $this->buyerTransformer = new BuyerTransformer();
    }

    public function testIfIsImplementingStrategyInterface()
    {
        $this->assertInstanceOf(
            'Team3\PayU\Order\Transformer\UserOrder\Strategy\UserOrderTransformerStrategyInterface',
            $this->buyerTransformer
        );
    }

    public function testIfSupportsOnlyCertainPropertyName()
    {
        $this->assertTrue(
            $this->buyerTransformer->supports('buyer.test')
        );
        $this->assertFalse(
            $this->buyerTransformer->supports('non-buyer')
        );
        $this->assertFalse(
            $this->buyerTransformer->supports('buyer')
        );
    }

    public function testIfAllValuesAreCopied()
    {
        $order = new Order();
        $buyer = new BuyerModelWithPrivateMethods();

        $this->copyAllValues($order, $buyer);

        $buyer = $order->getBuyer();
        $this->assertNotEmpty($buyer->getFirstName());
        $this->assertNotEmpty($buyer->getLastName());
        $this->assertNotEmpty($buyer->getEmail());
        $this->assertNotEmpty($buyer->getPhone());
    }

    /**
     * @param OrderInterface               $order
     * @param BuyerModelWithPrivateMethods $buyer
     */
    private function copyAllValues(
        OrderInterface $order,
        BuyerModelWithPrivateMethods $buyer
    ) {
        $results = $this
            ->extractor
            ->extract($buyer);

        /** @var ExtractorResult $result */
        foreach ($results as $result) {
            if ($this->buyerTransformer->supports($result->getPropertyName())) {
                $this->buyerTransformer->transform(
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
