<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Communication\RequestBuilder;

use Team3\Communication\Request\PayURequestInterface;
use Team3\Order\Model\OrderInterface;

interface RequestBuilderInterface
{
    /**
     * @param OrderInterface $order
     *
     * @return PayURequestInterface
     */
    public function build(OrderInterface $order);
}
