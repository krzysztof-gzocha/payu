<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Communication\Process\ResponseDeserializer;

use Psr\Log\LoggerInterface;

interface ResponseDeserializerFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return ResponseDeserializer
     */
    public function build(LoggerInterface $logger);
}
