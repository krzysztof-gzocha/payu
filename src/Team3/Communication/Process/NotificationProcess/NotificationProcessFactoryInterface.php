<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Communication\Process\NotificationProcess;

use Psr\Log\LoggerInterface;

interface NotificationProcessFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return NotificationProcess
     */
    public function build(LoggerInterface $logger);
}
