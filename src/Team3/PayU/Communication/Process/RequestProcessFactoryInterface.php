<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Process;

use Psr\Log\LoggerInterface;

/**
 * Will return {@link RequestProcess}
 *
 * Interface RequestProcessFactoryInterface
 * @package Team3\PayU\Communication\Process
 */
interface RequestProcessFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return RequestProcess
     */
    public function build(LoggerInterface $logger);
}
