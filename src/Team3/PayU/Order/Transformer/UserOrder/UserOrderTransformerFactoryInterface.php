<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Order\Transformer\UserOrder;

use Psr\Log\LoggerInterface;

interface UserOrderTransformerFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return UserOrderTransformer
     */
    public function build(LoggerInterface $logger);
}
