<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication\Request;

class OrderCreateRequest extends AbstractPayURequest
{
    /**
     * @param string $data
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->path = '/orders';
    }
}
