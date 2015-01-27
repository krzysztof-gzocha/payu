<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\PropertyExtractor\Reader;

class ReaderResult implements ReaderResultInterface
{
    /**
     * @var string
     */
    private $methodName;

    /**
     * @var string
     */
    private $propertyName;

    /**
     * @param string $methodName
     * @param string $propertyName
     */
    public function __construct(
        $methodName,
        $propertyName
    ) {
        $this->methodName = $methodName;
        $this->propertyName = $propertyName;
    }

    /**
     * @return string
     */
    public function getMethodName()
    {
        return $this->methodName;
    }

    /**
     * @return string
     */
    public function getPropertyName()
    {
        return $this->propertyName;
    }
}
