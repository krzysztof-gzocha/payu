<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Communication\Process;

use Psr\Log\LoggerInterface;

interface RequestProcessFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return RequestProcess
     */
    public function build(LoggerInterface $logger);
}
