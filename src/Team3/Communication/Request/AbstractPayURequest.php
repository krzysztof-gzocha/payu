<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication\Request;

use Team3\Order\Serializer\SerializableInterface;

abstract class AbstractPayURequest implements PayURequestInterface
{
    /**
     * @var SerializableInterface
     */
    protected $data;

    /**
     * @var string
     */
    protected $path;

    /**
     * @return SerializableInterface
     */
    public function getDataObject()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return self::METHOD_POST;
    }
}
