<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\Order\Transformer\UserOrder\Strategy\Product;

use Team3\PayU\Order\Model\Products\Product;
use Team3\PayU\Order\Model\Products\ProductInterface;
use Team3\PayU\Order\Transformer\UserOrder\TransformerProperties;
use Team3\PayU\PropertyExtractor\ExtractorInterface;
use Team3\PayU\PropertyExtractor\ExtractorResult;

class SingleProductTransformer
{
    /**
     * @var ExtractorInterface
     */
    private $extractor;

    /**
     * @param ExtractorInterface $extractor
     */
    public function __construct(ExtractorInterface $extractor)
    {
        $this->extractor = $extractor;
    }

    /**
     * @param $userProduct
     *
     * @return ProductInterface
     */
    public function transform($userProduct)
    {
        $product = new Product();

        foreach ($this->getExtractedAnnotations($userProduct) as $extractionResult) {
            $this->transformParameter($product, $extractionResult);
        }

        return $product;
    }

    /**
     * @param object $userProduct
     *
     * @return ExtractorResult[]
     */
    private function getExtractedAnnotations($userProduct)
    {
        return $this
            ->extractor
            ->extract($userProduct);
    }

    /**
     * @param ProductInterface $product
     * @param ExtractorResult  $extractionResult
     */
    private function transformParameter(
        ProductInterface $product,
        ExtractorResult $extractionResult
    ) {
        switch ($extractionResult->getPropertyName()) {
            case TransformerProperties::PRODUCT_UNIT_PRICE:
                $product->setUnitPrice($extractionResult->getValue());
                break;
            case TransformerProperties::PRODUCT_QUANTITY:
                $product->setQuantity($extractionResult->getValue());
                break;
            case TransformerProperties::PRODUCT_NAME:
                $product->setName($extractionResult->getValue());
                break;
            default:
        }
    }
}
