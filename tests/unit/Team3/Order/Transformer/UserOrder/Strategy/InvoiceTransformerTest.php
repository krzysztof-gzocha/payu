<?php
namespace Team3\Order\Transformer\UserOrder\Strategy;

use Psr\Log\LoggerInterface;
use Team3\Order\Model\Order;
use Team3\Order\Model\OrderInterface;
use Team3\PropertyExtractor\Extractor;
use Team3\PropertyExtractor\ExtractorInterface;
use Team3\PropertyExtractor\ExtractorResult;
use Team3\PropertyExtractor\Reader\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationReader as DoctrineAnnotationReader;
use tests\unit\Team3\Order\Transformer\UserOrder\Strategy\Model\InvoiceModelWithPrivateMethods;

class InvoiceTransformerTest extends \Codeception\TestCase\Test
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
     * @var InvoiceTransformer
     */
    protected $invoiceTransformer;

    protected function _before()
    {
        $this->extractor = new Extractor(
            new AnnotationReader(
                new DoctrineAnnotationReader(),
                $this->getLogger()
            ),
            $this->getLogger()
        );

        $this->invoiceTransformer = new InvoiceTransformer();
    }

    public function testIfImplementsStrategyInterface()
    {
        $this->assertInstanceOf(
            'Team3\Order\Transformer\UserOrder\Strategy\UserOrderTransformerStrategyInterface',
            $this->invoiceTransformer
        );
    }

    public function testIfSupportsOnlyCertainPropertyName()
    {
        $this->assertTrue(
            $this->invoiceTransformer->supports('invoice.test')
        );
        $this->assertFalse(
            $this->invoiceTransformer->supports('invoice.')
        );
        $this->assertFalse(
            $this->invoiceTransformer->supports('no-invoice.test')
        );
    }

    public function testIfAllValuesAreCopied()
    {
        $order = new Order();
        $invoiceModel = new InvoiceModelWithPrivateMethods();

        $this->copyAllValues($order, $invoiceModel);

        $invoice = $order->getBuyer()->getInvoice();
        $this->assertNotEmpty($invoice->getCity());
        $this->assertNotEmpty($invoice->getCountryCode());
        $this->assertNotEmpty($invoice->getName());
        $this->assertNotEmpty($invoice->getPostalCode());
        $this->assertNotEmpty($invoice->getRecipientEmail());
        $this->assertNotEmpty($invoice->getRecipientName());
        $this->assertNotEmpty($invoice->getRecipientPhone());
        $this->assertNotEmpty($invoice->getStreet());
        $this->assertNotEmpty($invoice->getRecipientTin());
        $this->assertNotEmpty($invoice->isEInvoiceRequested());
    }

    /**
     * @param OrderInterface                 $order
     * @param InvoiceModelWithPrivateMethods $invoice
     */
    private function copyAllValues(
        OrderInterface $order,
        InvoiceModelWithPrivateMethods $invoice
    ) {
        $results = $this
            ->extractor
            ->extract($invoice);

        /** @var ExtractorResult $result */
        foreach ($results as $result) {
            if ($this->invoiceTransformer->supports($result->getPropertyName())) {
                $this->invoiceTransformer->transform(
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
