<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer\ArrayAdapter\Step;

use Team3\Order\Model\OrderInterface;
use Team3\Order\Serializer\ArrayAdapter\Names\BuyerParametersNames as BuyerNames;

class BuyerAdapterStep extends AbstractAdapterStep
{
    /**
     * @param OrderInterface $order
     *
     * @return array
     */
    public function toArray(OrderInterface $order)
    {
        $buyer = $order->getBuyer();
        $resultArray = [
            BuyerNames::EMAIL => $buyer->getEmail(),
            BuyerNames::FIRST_NAME => $buyer->getFirstName(),
            BuyerNames::LAST_NAME => $buyer->getLastName(),
        ];

        if ($buyer->getPhone()) {
            $resultArray[BuyerNames::PHONE] = $buyer->getPhone();
        }

        return $this->addResultsFromSteps($resultArray, $order);
    }

    /**
     * @param OrderInterface $order
     *
     * @return bool
     */
    public function shouldAdapt(OrderInterface $order)
    {
        $buyer = $order->getBuyer();

        return $buyer->getEmail()
            && $buyer->getFirstName()
            && $buyer->getLastName();
    }
}
