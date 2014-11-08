<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace tests\unit\Team3\Order\Transformer\UserOrder\Strategy;

use Team3\Order\Annotation\PayU;

class UserOrderModelWithPrivateMethod
{
    /**
     * @var mixed
     */
    private $products;

    /**
     * @param mixed $products
     */
    public function __construct($products)
    {
        $this->products = $products;
    }

    /**
     * @return array
     * @PayU(propertyName="productCollection")
     */
    private function getProducts()
    {
        return $this->products;
    }
}
