<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication\Request;

abstract class AbstractPayURequest implements PayURequestInterface
{
    /**
     * @var string
     */
    protected $data;

    /**
     * @var string
     */
    protected $path;

    /**
     * @return string
     */
    public function getData()
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
}
