<?php

namespace spec\Team3\Order\Model\Products;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Team3\Order\Model\Products\Product;

class ProductCollectionSpec extends ObjectBehavior
{
    const TESTED_NUMBER_OF_PRODUCTS = 4;

    function it_is_initializable()
    {
        $this->shouldHaveType('Team3\Order\Model\Products\ProductCollection');
    }

    function it_returns_correct_number_of_products()
    {
        for ($i = 0; $i < self::TESTED_NUMBER_OF_PRODUCTS; $i++) {
            $this->addProduct($this->getProduct(sprintf('#%s', $i)));
        }

        $this->shouldHaveCount(self::TESTED_NUMBER_OF_PRODUCTS);
        $this->getProducts()->shouldHaveCount(self::TESTED_NUMBER_OF_PRODUCTS);
    }

    function it_return_products_with_correct_keys()
    {
        $this->setProducts([
            2 => $this->getProduct('#1'),
            4 => $this->getProduct('#2'),
            'test' => $this->getProduct('#3'),
            true => $this->getProduct('#4'),
        ]);

        $this->getProducts()->shouldHaveOrderedKeys();
    }

    /**
     * @param string $name
     *
     * @return Product
     */
    private function getProduct($name)
    {
        return (new Product())->setName($name);
    }

    /**
     * @return array
     */
    public function getMatchers()
    {
        return [
            'haveOrderedKeys' => function($subject) {
                $i = 0;
                foreach ($subject as $key => $value) {
                    if ($key !== $i++) {
                        return false;
                    }
                }

                return true;
            }
        ];
    }
}
