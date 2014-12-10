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

class ProductStrategy extends AbstractValidator
{
    const MINIMAL_PRICE = 0.01;
    const MINIMAL_QUANTITY = 1;
    const MINIMAL_PRODUCT_NAME_LENGTH = 1;

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
        if (self::MINIMAL_PRODUCT_NAME_LENGTH > mb_strlen($product->getName())) {
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

        $value = $product->getUnitPrice()->getValue();

        if (1 === bccomp(self::MINIMAL_PRICE, $value)) {
            $this->addValidationError(
                $product,
                sprintf(
                    'Products price can not be less then %s',
                    self::MINIMAL_PRICE
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
