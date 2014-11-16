<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Model;

trait IsFilledTrait
{
    /**
     * Return true if given object is filled
     *
     * @return bool
     */
    public function isFilled()
    {
        $reflectionClass = new \ReflectionClass($this);
        $reflectionProperties = $reflectionClass->getProperties();

        /** @var \ReflectionProperty $reflectionProperty */
        foreach ($reflectionProperties as $reflectionProperty) {
            $reflectionProperty->setAccessible(true);
            $value = $reflectionProperty->getValue($this);

            if ($value instanceof IsFilledInterface) {
                if ($value->isFilled()) {
                    return true;
                }
                break;
            }

            if (null !== $value) {
                return true;
            }
        }

        return false;
    }
}
