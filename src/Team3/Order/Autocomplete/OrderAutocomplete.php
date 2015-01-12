<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Autocomplete;

use Psr\Log\LoggerInterface;
use Team3\Configuration\ConfigurationInterface;
use Team3\Order\Autocomplete\Strategy\AutocompleteStrategyInterface;
use Team3\Order\Model\OrderInterface;

class OrderAutocomplete implements OrderAutocompleteInterface
{
    /**
     * @var AutocompleteStrategyInterface[]
     */
    private $strategies;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->strategies = [];
        $this->logger = $logger;
    }

    /**
     * @param OrderInterface         $order
     * @param ConfigurationInterface $configuration
     */
    public function autocomplete(
        OrderInterface $order,
        ConfigurationInterface $configuration
    ) {
        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($order)) {
                $strategy->autocomplete($order, $configuration);
                $this->logAutocompletion($order, $strategy);
            }
        }
    }

    /**
     * @param AutocompleteStrategyInterface $autocompleteStrategy
     *
     * @return $this
     */
    public function addStrategy(
        AutocompleteStrategyInterface $autocompleteStrategy
    ) {
        $this->strategies[] = $autocompleteStrategy;

        return $this;
    }

    /**
     * @param OrderInterface                $order
     * @param AutocompleteStrategyInterface $strategy
     */
    private function logAutocompletion(
        OrderInterface $order,
        AutocompleteStrategyInterface $strategy
    ) {
        $this
            ->logger
            ->info(
                sprintf(
                    'Order with ID %s parameters were autocompleted by %s',
                    $order->getOrderId(),
                    get_class($strategy)
                ),
                [
                    'order' => $order,
                    'strategy' => $strategy,
                ]
            );
    }
}
