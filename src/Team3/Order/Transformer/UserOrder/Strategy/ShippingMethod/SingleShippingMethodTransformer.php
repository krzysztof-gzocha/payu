<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy\ShippingMethod;

use Team3\Order\Model\ShippingMethods\ShippingMethod;
use Team3\Order\Model\ShippingMethods\ShippingMethodInterface;
use Team3\Order\PropertyExtractor\ExtractorInterface;
use Team3\Order\PropertyExtractor\ExtractorResult;

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
        return true == preg_match('/^shippingMethod\.\w+/', $propertyName);
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
            case 'shippingMethod.name':
                $shippingMethod->setName($extractorResult->getValue());
                break;
            case 'shippingMethod.price':
                $shippingMethod->setPrice($extractorResult->getValue());
                break;
            case 'shippingMethod.country':
                $shippingMethod->setCountry($extractorResult->getValue());
                break;
            default:
        }
    }
}
