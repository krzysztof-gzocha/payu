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

class BuyerInSeparateEntityTransformerTest extends \Codeception\TestCase\Test
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
    protected $buyerInSeparateEntityTransformer;

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

        $this->transformer->addStrategy(new BuyerTransformer());

        $this->buyerInSeparateEntityTransformer = new BuyerInSeparateEntityTransformer();
        $this->buyerInSeparateEntityTransformer->setMainTransformer($this->transformer);
    }

    public function testIfSupportsOnlyCertainPropertyNames()
    {
        $this->assertTrue(
            $this->buyerInSeparateEntityTransformer->supports('buyer')
        );
        $this->assertFalse(
            $this->buyerInSeparateEntityTransformer->supports('non-buyer')
        );
    }

    public function testResultsFromSeparateEntity()
    {
        $order = new Order();
        $userOrder = new UserOrderModelWithPrivateMethods();

        $this->copyAllValues($order, $userOrder);
        $buyer = $order->getBuyer();
        $this->assertNotEmpty($buyer->getEmail());
        $this->assertNotEmpty($buyer->getFirstName());
        $this->assertNotEmpty($buyer->getLastName());
        $this->assertNotEmpty($buyer->getPhone());
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
            if ($this->buyerInSeparateEntityTransformer->supports($result->getPropertyName())) {
                $this->buyerInSeparateEntityTransformer->transform(
                    $order,
                    $result
                );
            }
        }
    }
}
