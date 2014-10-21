<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Order\Annotation;

interface OrderAnnotationInterface
{
    /**
     * @return OrderPropertyAnnotationInterface[]
     */
    public function getProperties();
}
