<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication\Request;

interface PayURequestInterface
{
    /**
     * @return string
     */
    public function getData();

    /**
     * @return string
     */
    public function getPath();
}
