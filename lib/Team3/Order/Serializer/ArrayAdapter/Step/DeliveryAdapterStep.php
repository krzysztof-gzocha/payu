<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Serializer\ArrayAdapter\Step;

use Team3\Order\Model\Buyer\DeliveryInterface;
use Team3\Order\Model\OrderInterface;
use Team3\Order\Serializer\ArrayAdapter\Names\DeliveryParametersNames as DeliveryNames;

class DeliveryAdapterStep extends AbstractAdapterStep
{
    /**
     * @param OrderInterface $order
     *
     * @return array
     */
    public function toArray(OrderInterface $order)
    {
        $delivery = $order->getBuyer()->getDelivery();
        $resultArray = [
            DeliveryNames::STREET => $delivery->getStreet(),
            DeliveryNames::POSTAL_CODE => $delivery->getPostalCode(),
            DeliveryNames::CITY => $delivery->getCity(),
            DeliveryNames::COUNTRY_CODE => $delivery->getCountryCode(),
        ];

        return $this->addOptional(
            $resultArray,
            $delivery
        );
    }

    /**
     * @param OrderInterface $order
     *
     * @return bool
     */
    public function shouldAdapt(OrderInterface $order)
    {
        if (!$order->getBuyer() || !$order->getBuyer()->getDelivery()) {
            return false;
        }
        $delivery = $order->getBuyer()->getDelivery();

        return $delivery->getStreet()
            && $delivery->getPostalCode()
            && $delivery->getCity()
            && $delivery->getCountryCode();
    }

    /**
     * @param array             $resultArray
     * @param DeliveryInterface $delivery
     *
     * @return array
     */
    private function addOptional(array $resultArray, DeliveryInterface $delivery)
    {
        if ($delivery->getName()) {
            $resultArray[DeliveryNames::NAME] = $delivery->getName();
        }

        if ($delivery->getRecipientName()) {
            $resultArray[DeliveryNames::RECIPIENT_NAME] = $delivery->getRecipientName();
        }

        if ($delivery->getRecipientEmail()) {
            $resultArray[DeliveryNames::RECIPIENT_EMAIL] = $delivery->getRecipientEmail();
        }

        if ($delivery->getRecipientPhone()) {
            $resultArray[DeliveryNames::RECIPIENT_PHONE] = $delivery->getRecipientPhone();
        }

        return $resultArray;
    }
}
