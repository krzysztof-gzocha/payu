<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Transformer\UserOrder\Strategy\Product;

use Team3\Order\Annotation\Extractor\AnnotationsExtractorInterface;
use Team3\Order\Annotation\Extractor\AnnotationsExtractorResult;
use Team3\Order\Model\Products\Product;
use Team3\Order\Model\Products\ProductInterface;
use \ReflectionMethod;

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
            $this->transformParameter($product, $userProduct, $extractionResult);
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
     * @param object                     $userProduct
     * @param AnnotationsExtractorResult $extractionResult
     */
    private function transformParameter(
        ProductInterface $product,
        $userProduct,
        AnnotationsExtractorResult $extractionResult
    ) {
        switch ($extractionResult->getAnnotation()->getPropertyName()) {
            case 'product.unitPrice':
                $product->setUnitPrice($this->getMethodValue(
                    $userProduct,
                    $extractionResult->getReflectionMethod())
                );
                break;
            case 'product.quantity':
                $product->setQuantity($this->getMethodValue(
                    $userProduct,
                    $extractionResult->getReflectionMethod()
                ));
                break;
            case 'product.name':
                $product->setName($this->getMethodValue(
                    $userProduct,
                    $extractionResult->getReflectionMethod()
                ));
                break;
            default:
        }
    }

    /**
     * @param object           $userProduct
     * @param ReflectionMethod $reflectionMethod
     *
     * @return mixed
     */
    private function getMethodValue($userProduct, ReflectionMethod $reflectionMethod)
    {
        $reflectionMethod->setAccessible(true);

        return $reflectionMethod->invoke($userProduct);
    }
}
