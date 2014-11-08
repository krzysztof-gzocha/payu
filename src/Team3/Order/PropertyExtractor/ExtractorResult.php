<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Order\PropertyExtractor;

/**
 * Class ExtractorResult
 * @package Team3\Order\Annotation\Extractor
 */
class ExtractorResult
{
    /**
     * @var string
     */
    protected $propertyName;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param string $propertyName
     * @param mixed  $value
     */
    public function __construct(
        $propertyName,
        $value
    ) {
        $this->propertyName = $propertyName;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getPropertyName()
    {
        return $this->propertyName;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
