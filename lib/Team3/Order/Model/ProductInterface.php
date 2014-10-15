<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Model;

interface ProductInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return int
     */
    public function getQuantity();

    /**
     * @return string
     */
    public function getUnitPrice();
}
