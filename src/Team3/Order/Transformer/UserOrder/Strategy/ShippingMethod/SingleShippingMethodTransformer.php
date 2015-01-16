<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy\ShippingMethod;

use Team3\Order\Model\ShippingMethods\ShippingMethod;
use Team3\Order\Model\ShippingMethods\ShippingMethodInterface;
use Team3\Order\Transformer\UserOrder\TransformerProperties;
use Team3\Order\Transformer\UserOrder\TransformerPropertiesRegExp;
use Team3\PropertyExtractor\ExtractorInterface;
use Team3\PropertyExtractor\ExtractorResult;

class SingleShippingMethodTransformer
{
    /**
     * @var ExtractorInterface
     */
    private $extractor;

    /**
     * @param ExtractorInterface $extractor
     */
    public function __construct(
        ExtractorInterface $extractor
    ) {
        $this->extractor = $extractor;
    }

    /**
     * @param mixed $usersShippingMethod
     *
     * @return ShippingMethod
     */
    public function transform($usersShippingMethod)
    {
        $shippingMethod = new ShippingMethod();

        foreach ($this->extractor->extract($usersShippingMethod) as $extractedResult) {
            if ($this->supports($extractedResult->getPropertyName())) {
                $this->copyValue($shippingMethod, $extractedResult);
            }
        }

        return $shippingMethod;
    }

    /**
     * @param string $propertyName
     *
     * @return bool
     */
    protected function supports($propertyName)
    {
        return 1 === preg_match(
            TransformerPropertiesRegExp::SHIPPING_METHOD_REGEXP,
            $propertyName
        );
    }

    /**
     * @param ShippingMethodInterface $shippingMethod
     * @param ExtractorResult         $extractorResult
     */
    protected function copyValue(
        ShippingMethodInterface $shippingMethod,
        ExtractorResult $extractorResult
    ) {
        switch ($extractorResult->getPropertyName()) {
            case TransformerProperties::SHIPPING_METHOD_NAME:
                $shippingMethod->setName($extractorResult->getValue());
                break;
            case TransformerProperties::SHIPPING_METHOD_PRICE:
                $shippingMethod->setPrice($extractorResult->getValue());
                break;
            case TransformerProperties::SHIPPING_METHOD_COUNTRY:
                $shippingMethod->setCountry($extractorResult->getValue());
                break;
            default:
        }
    }
}
