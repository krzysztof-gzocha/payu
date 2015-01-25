<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\Order\Model\Buyer;

use JMS\Serializer\Annotation as JMS;
use Team3\PayU\Order\Model\Traits\AddressTrait;

/**
 * Class Invoice
 * @package Team3\PayU\Order\Model\Buyer
 * @JMS\AccessorOrder("alphabetical")
 */
class Invoice implements InvoiceInterface
{
    use AddressTrait;

    /**
     * @var string
     * @JMS\SerializedName("tin")
     */
    protected $recipientTin;

    /**
     * @var bool
     * @JMS\SerializedName("einvoiceRequested")
     */
    protected $eInvoiceRequested;

    /**
     * @return boolean
     */
    public function isEInvoiceRequested()
    {
        return $this->eInvoiceRequested;
    }

    /**
     * @param boolean $eInvoiceRequested
     *
     * @return Invoice
     */
    public function setEInvoiceRequested($eInvoiceRequested)
    {
        $this->eInvoiceRequested = $eInvoiceRequested;

        return $this;
    }

    /**
     * @return string
     */
    public function getRecipientTin()
    {
        return $this->recipientTin;
    }

    /**
     * @param string $recipientTin
     *
     * @return Invoice
     */
    public function setRecipientTin($recipientTin)
    {
        $this->recipientTin = $recipientTin;

        return $this;
    }
}
