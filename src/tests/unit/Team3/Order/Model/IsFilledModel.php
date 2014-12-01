<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace tests\unit\Team3\Order\Model;

use Team3\Order\Model\IsFilledInterface;
use Team3\Order\Model\IsFilledTrait;

class IsFilledModel implements IsFilledInterface
{
    use IsFilledTrait;

    /**
     * @var IsFilledInterface
     */
    private $secondFilledModel;

    /**
     * @var string
     */
    private $property;

    /**
     * @param IsFilledInterface $filledObject
     * @param                   $property
     */
    public function __construct(IsFilledInterface $filledObject = null, $property = null)
    {
        $this->secondFilledModel = $filledObject;
        $this->property = $property;
    }

    /**
     * @return IsFilledInterface
     */
    public function getSecondFilledModel()
    {
        return $this->secondFilledModel;
    }

    /**
     * @return string
     */
    public function getProperty()
    {
        return $this->property;
    }
}
