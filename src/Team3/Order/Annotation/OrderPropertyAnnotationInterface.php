<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Annotation;

interface OrderPropertyAnnotationInterface
{
    /**
     * @return string
     */
    public function getPropertyName();

    /**
     * @return string
     */
    public function getType();
}
