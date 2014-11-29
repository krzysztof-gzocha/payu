<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy\Product;

use Team3\Order\Model\Products\Product;
use Team3\Order\Model\Products\ProductInterface;
use Team3\PropertyExtractor\ExtractorInterface;
use Team3\PropertyExtractor\ExtractorResult;

class SingleProductTransformer
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
            case 'product.unitPrice':
                $product->setUnitPrice($extractionResult->getValue());
                break;
            case 'product.quantity':
                $product->setQuantity($extractionResult->getValue());
                break;
            case 'product.name':
                $product->setName($extractionResult->getValue());
                break;
            default:
        }
    }
}
