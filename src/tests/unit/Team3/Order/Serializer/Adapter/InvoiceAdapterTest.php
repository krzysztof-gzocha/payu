<?php
namespace Team3\Order\Serializer\Adapter;

use Team3\Order\Model\Buyer\InvoiceInterface;
use tests\unit\Team3\Order\Serializer\OrderHelper;

/**
 * Class InvoiceAdapterTest
 * @package Team3\Order\Serializer\Adapter
 * @group serializer
 */
class InvoiceAdapterTest extends \Codeception\TestCase\Test
{
    /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var InvoiceInterface
     */
    protected $invoice;

    /**
     * @var InvoiceAdapter
     */
    protected $adapter;

    protected function _before()
    {
        $this->invoice = OrderHelper::getOrderWithDeliveryAndInvoice()->getBuyer()->getInvoice();
        $this->adapter = new InvoiceAdapter($this->invoice);
    }

    public function testIfMethodsAreProxed()
    {
        $this->assertEquals(
            $this->invoice->getCity(),
            $this->adapter->getCity()
        );
        $this->assertEquals(
            $this->invoice->getCountryCode(),
            $this->adapter->getCountryCode()
        );
        $this->assertEquals(
            $this->invoice->getName(),
            $this->adapter->getName()
        );
        $this->assertEquals(
            $this->invoice->getPostalCode(),
            $this->adapter->getPostalCode()
        );
        $this->assertEquals(
            $this->invoice->getRecipientEmail(),
            $this->adapter->getRecipientEmail()
        );
        $this->assertEquals(
            $this->invoice->getRecipientName(),
            $this->adapter->getRecipientName()
        );
        $this->assertEquals(
            $this->invoice->getRecipientPhone(),
            $this->adapter->getRecipientPhone()
        );
        $this->assertEquals(
            $this->invoice->getStreet(),
            $this->adapter->getStreet()
        );
        $this->assertEquals(
            $this->invoice->getTin(),
            $this->adapter->getTin()
        );
        $this->assertEquals(
            $this->invoice->isEInvoiceRequested(),
            $this->adapter->isEInvoiceRequested()
        );
    }
}
