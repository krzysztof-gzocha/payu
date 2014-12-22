<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Annotation;

use Doctrine\Common\Annotations\Annotation\Target;

/**
 * Class PayU
 * @package Team3\Annotation
 * @Annotation
 * @Target({"METHOD"})
 */
class PayU
{
    /**
     * @var string
     */
    public $propertyName;

    /**
     * @param array $values
     */
    public function __construct(array $values = [])
    {
        if (array_key_exists('propertyName', $values)) {
            $this->propertyName = $values['propertyName'];
        }
    }

    /**
     * @return string
     */
    public function getPropertyName()
    {
        return $this->propertyName;
    }
}
