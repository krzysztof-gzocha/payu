<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer\ArrayAdapter\Step;

use Team3\Order\Model\General\GeneralInterface;
use Team3\Order\Model\OrderInterface;
use Team3\Order\Serializer\ArrayAdapter\GeneralParametersNames as GeneralKeys;

class GeneralParametersAdapterStep extends AbstractAdapterStep
{
    /**
     * @param OrderInterface $order
     *
     * @return array
     */
    public function toArray(OrderInterface $order)
    {
        $generalParameters = $order->getGeneral();
        $resultArray = [
            GeneralKeys::CUSTOMER_IP => $generalParameters->getCustomerIp(),
            GeneralKeys::MERCHANT_ID => $generalParameters->getMerchantPosId(),
            GeneralKeys::DESCRIPTION => $generalParameters->getDescription(),
            GeneralKeys::CURRENCY_CODE => $generalParameters->getCurrencyCode(),
            GeneralKeys::TOTAL_AMOUNT => $generalParameters->getTotalAmount(),
            GeneralKeys::SIGNATURE => $generalParameters->getSignature(),
        ];

        return $this->addOptional($resultArray, $generalParameters);
    }

    /**
     * @param OrderInterface $order
     *
     * @return bool
     */
    public function shouldAdapt(OrderInterface $order)
    {
        $general = $order->getGeneral();

        return $general
            && $general->getCustomerIp()
            && $general->getMerchantPosId()
            && $general->getDescription()
            && $general->getCurrencyCode()
            && $general->getTotalAmount()
            && $general->getSignature();
    }

    private function addOptional(array $resultArray, GeneralInterface $general)
    {
        if ($general->getOrderId()) {
            $resultArray[GeneralKeys::ORDER_ID] = $general->getOrderId();
        }

        if ($general->getAdditionalDescription()) {
            $resultArray[GeneralKeys::ADDITIONAL_DESCRIPTION] = $general->getAdditionalDescription();
        }

        return $resultArray;
    }
}
