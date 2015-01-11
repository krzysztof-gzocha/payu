<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Communication\Process\NotificationProcess;

use Psr\Log\LoggerInterface;

interface OrderNotificationProcessFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return OrderNotificationProcess
     */
    public function build(LoggerInterface $logger);
}
