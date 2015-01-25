<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Order\Autocomplete;

use Psr\Log\LoggerInterface;

interface OrderAutocompleteFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return OrderAutocompleteInterface
     */
    public function build(LoggerInterface $logger);
}
