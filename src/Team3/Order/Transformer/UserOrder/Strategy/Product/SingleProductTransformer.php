<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy\Product;

use Team3\Order\Annotation\Extractor\AnnotationsExtractorInterface;
use Team3\Order\Annotation\Extractor\AnnotationsExtractorResult;
use Team3\Order\Model\Products\Product;
use Team3\Order\Model\Products\ProductInterface;

class SingleProductTransformer
{
    /**
     * @var AnnotationsExtractorInterface
     */
    private $annotationsExtractor;

    /**
     * @param AnnotationsExtractorInterface $annotationsExtractor
     */
    public function __construct(
        AnnotationsExtractorInterface $annotationsExtractor
    ) {
        $this->annotationsExtractor = $annotationsExtractor;
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
     * @return AnnotationsExtractorResult[]
     */
    private function getExtractedAnnotations($userProduct)
    {
        return $this
            ->annotationsExtractor
            ->extract($userProduct);
    }

    /**
     * @param ProductInterface           $product
     * @param AnnotationsExtractorResult $extractionResult
     */
    private function transformParameter(
        ProductInterface $product,
        AnnotationsExtractorResult $extractionResult
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
