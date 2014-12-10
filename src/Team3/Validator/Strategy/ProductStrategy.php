<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Validator\Strategy;

use Team3\Order\Model\Money\MoneyInterface;
use Team3\Order\Model\OrderInterface;
use Team3\Order\Model\Products\ProductCollectionInterface;
use Team3\Order\Model\Products\ProductInterface;
use Team3\Validator\AbstractValidator;
use Team3\Validator\ValidationHelperTrait;

class ProductStrategy extends AbstractValidator
{
    use ValidationHelperTrait;
    const MINIMAL_QUANTITY  = 1;

    /**
     * @inheritdoc
     */
    public function validate(OrderInterface $order)
    {
        $productCollection = $order->getProductCollection();

        if ($this->shouldNotValidate($productCollection)) {
            return true;
        }

        /** @var ProductInterface $product */
        foreach ($productCollection as $product) {
            $this
                ->checkName($product)
                ->checkPrice($product)
                ->checkQuantity($product);
        }

        return $this->hasNoErrors();
    }

    /**
     * @param ProductCollectionInterface $productCollection
     *
     * @return bool
     */
    protected function shouldNotValidate(
        ProductCollectionInterface $productCollection
    ) {
        return 0 === $productCollection->count();
    }

    /**
     * @param ProductInterface $product
     *
     * @return $this
     */
    protected function checkName(ProductInterface $product)
    {
        if ($this->isStringEmpty($product->getName())) {
            $this->addValidationError(
                $product,
                'Products name can not be empty',
                'name'
            );
        }

        return $this;
    }

    /**
     * @param ProductInterface $product
     *
     * @return $this
     */
    protected function checkPrice(ProductInterface $product)
    {
        if (!$product->getUnitPrice() instanceof MoneyInterface) {
            $this->addValidationError(
                $product,
                'Products price have te be instance of MoneyInterface',
                'unitPrice'
            );

            return $this;
        }

        if ($this->isMoneyNegative($product->getUnitPrice())) {
            $this->addValidationError(
                $product,
                sprintf(
                    'Products price can not be less then %s',
                    $this->getMinimalPrice()
                ),
                'unitPrice'
            );
        }

        return $this;
    }

    /**
     * @param ProductInterface $product
     *
     * @return $this
     */
    protected function checkQuantity(ProductInterface $product)
    {
        if (self::MINIMAL_QUANTITY > $product->getQuantity()) {
            $this->addValidationError(
                $product,
                sprintf(
                    'Products quantity can not be less then %s',
                    self::MINIMAL_QUANTITY
                ),
                'quantity'
            );
        }

        return $this;
    }
}
