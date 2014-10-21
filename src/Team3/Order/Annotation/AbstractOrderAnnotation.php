<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\Annotation;

/**
 * Class AbstractOrderAnnotation
 * @package Team3\Order\Annotation
 */
abstract class AbstractOrderAnnotation implements OrderAnnotationInterface
{
    /**
     * @var OrderPropertyAnnotationInterface
     */
    private $properties;

    /**
     * @param array $values
     */
    public function __construct(array $values)
    {
        $this->properties = $values['properties'];
    }

    /**
     * @return OrderPropertyAnnotationInterface[]
     */
    public function getProperties()
    {
        return $this->properties;
    }
}
