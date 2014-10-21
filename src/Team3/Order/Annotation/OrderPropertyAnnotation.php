<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Annotation;

/**
 * Class OrderPropertyAnnotation
 * @package Team3\Order\Annotation
 * @Annotation
 */
class OrderPropertyAnnotation implements OrderPropertyAnnotationInterface
{
    /**
     * @var string
     */
    public $propertyName;

    /**
     * @var string
     */
    public $type;

    /**
     * @param array $values
     */
    public function __construct(array $values)
    {
        $this->propertyName = $values['propertyName'];
        $this->type = $values['type'];
    }

    /**
     * @return string
     */
    public function getPropertyName()
    {
        return $this->propertyName;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
