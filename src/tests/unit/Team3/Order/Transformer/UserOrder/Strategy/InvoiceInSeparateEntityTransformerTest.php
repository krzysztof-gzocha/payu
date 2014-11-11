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

class InvoiceInSeparateEntityTransformerTest extends \Codeception\TestCase\Test
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
    protected $invoiceInSeparateEntityTransformer;

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

        $this->transformer->addStrategy(new InvoiceTransformer());

        $this->invoiceInSeparateEntityTransformer = new InvoiceInSeparateEntityTransformer();
        $this->invoiceInSeparateEntityTransformer->setMainTransformer($this->transformer);
    }

    public function testIfSupportsOnlyCertainPropertyName()
    {
        $this->assertTrue(
            $this->invoiceInSeparateEntityTransformer->supports('invoice')
        );
        $this->assertFalse(
            $this->invoiceInSeparateEntityTransformer->supports('invoice.test')
        );
        $this->assertFalse(
            $this->invoiceInSeparateEntityTransformer->supports('non-invoice')
        );
    }

    public function testResultsFromSeparateEntity()
    {
        $order = new Order();
        $userOrder = new UserOrderModelWithPrivateMethods();

        $this->copyAllValues($order, $userOrder);
        $invoice = $order->getBuyer()->getInvoice();
        $this->assertNotEmpty($invoice->getCity());
        $this->assertNotEmpty($invoice->getCountryCode());
        $this->assertNotEmpty($invoice->getName());
        $this->assertNotEmpty($invoice->getPostalCode());
        $this->assertNotEmpty($invoice->getRecipientEmail());
        $this->assertNotEmpty($invoice->getRecipientName());
        $this->assertNotEmpty($invoice->getRecipientPhone());
        $this->assertNotEmpty($invoice->getStreet());
        $this->assertNotEmpty($invoice->getTin());
        $this->assertNotEmpty($invoice->isEInvoiceRequested());

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
            if ($this->invoiceInSeparateEntityTransformer->supports($result->getPropertyName())) {
                $this->invoiceInSeparateEntityTransformer->transform(
                    $order,
                    $result
                );
            }
        }
    }

}
