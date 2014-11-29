<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy\General;

use Team3\Order\Model\General\GeneralInterface;
use Team3\Order\Model\OrderInterface;
use Team3\PropertyExtractor\ExtractorResult;
use Team3\Order\Transformer\UserOrder\Strategy\UserOrderTransformerStrategyInterface;

class GeneralTransformer implements UserOrderTransformerStrategyInterface
{
    /**
     * @inheritdoc
     */
    public function transform(
        OrderInterface $order,
        ExtractorResult $extractorResult
    ) {
        $this->copyValue(
            $order->getGeneral(),
            $extractorResult->getPropertyName(),
            $extractorResult->getValue()
        );
    }

    /**
     * Will return true if property name starts with "general."
     *
     * @inheritdoc
     */
    public function supports($propertyName)
    {
        return true == preg_match('/^general\./', $propertyName);
    }

    /**
     * @param GeneralInterface $general
     * @param string           $propertyName
     * @param mixed            $value
     */
    private function copyValue(
        GeneralInterface $general,
        $propertyName,
        $value
    ) {
        switch ($propertyName) {
            case 'general.customerIp':
                $general->setCustomerIp($value);
                break;
            case 'general.orderId':
                $general->setOrderId($value);
                break;
            case 'general.additionalDescription':
                $general->setAdditionalDescription($value);
                break;
            case 'general.currencyCode':
                $general->setCurrencyCode($value);
                break;
            case 'general.description':
                $general->setDescription($value);
                break;
            case 'general.merchantPosId':
                $general->setMerchantPosId($value);
                break;
            case 'general.signature':
                $general->setSignature($value);
                break;
            case 'general.totalAmount':
                $general->setTotalAmount($value);
                break;
            default:
        }
    }
}
