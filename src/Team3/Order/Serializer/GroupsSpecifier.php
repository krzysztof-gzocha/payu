<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer;

use Psr\Log\LoggerInterface;
use Team3\Order\Model\Buyer\DeliveryInterface;
use Team3\Order\Model\Buyer\InvoiceInterface;
use Team3\Order\Model\OrderInterface;
use Team3\Order\Model\Products\ProductCollectionInterface;
use Team3\Order\Model\ShippingMethods\ShippingMethodCollectionInterface;

class GroupsSpecifier implements GroupsSpecifierInterface
{
    const DEFAULT_GROUP = 'Default';
    const BUYER_GROUP = 'buyer';
    const INVOICE_GROUP = 'invoice';
    const DELIVERY_GROUP = 'delivery';
    const SHIPPING_METHODS_GROUP = 'shippingMethods';
    const PRODUCT_COLLECTION_GROUP = 'products';

    /**
     * @var string[]
     */
    private $groups;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param  OrderInterface $order
     * @return array
     */
    public function specifyGroups(OrderInterface $order)
    {
        $this->groups = [self::DEFAULT_GROUP];

        $this->checkBuyer($order);
        $this->checkShippingMethods($order->getShippingMethodCollection());
        $this->checkProducts($order->getProductCollection());

        $this->logSpecifiedGroups($order);

        return $this->groups;
    }

    /**
     * @param OrderInterface $order
     *
     * @return $this
     */
    private function checkBuyer(OrderInterface $order)
    {
        $buyer = $order->getBuyer();
        if ($buyer->isFilled()) {
            $this->groups[] = self::BUYER_GROUP;
        }

        return $this
            ->checkInvoice($buyer->getInvoice())
            ->checkDelivery($buyer->getDelivery());
    }

    /**
     * @param InvoiceInterface $invoice
     *
     * @return $this
     */
    private function checkInvoice(InvoiceInterface $invoice)
    {
        if ($invoice->isFilled()) {
            $this->groups[] = self::INVOICE_GROUP;
        }

        return $this;
    }

    /**
     * @param DeliveryInterface $delivery
     *
     * @return $this
     */
    private function checkDelivery(DeliveryInterface $delivery)
    {
        if ($delivery->isFilled()) {
            $this->groups[] = self::DELIVERY_GROUP;
        }

        return $this;
    }

    /**
     * @param ShippingMethodCollectionInterface $shippingMethodCollection
     *
     * @return $this
     */
    private function checkShippingMethods(
        ShippingMethodCollectionInterface $shippingMethodCollection
    ) {
        if ($shippingMethodCollection->isFilled()) {
            $this->groups[] = self::SHIPPING_METHODS_GROUP;
        }

        return $this;
    }

    /**
     * @param ProductCollectionInterface $productCollection
     *
     * @return $this
     */
    private function checkProducts(
        ProductCollectionInterface $productCollection
    ) {
        if ($productCollection->isFilled()) {
            $this->groups[] = self::PRODUCT_COLLECTION_GROUP;
        }

        return $this;
    }

    /**
     * @param OrderInterface $order
     */
    private function logSpecifiedGroups(OrderInterface $order)
    {
        $this
            ->logger
            ->debug(sprintf(
                'Serialization groups for order %s were specified to %s',
                $order->getOrderId(),
                print_r($this->groups, true)
            ));
    }
}
