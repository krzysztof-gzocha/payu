<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication\Request;

use Team3\Serializer\SerializableInterface;

interface PayURequestInterface
{
    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';

    /**
     * @return SerializableInterface
     */
    public function getDataObject();

    /**
     * @return string
     */
    public function getPath();

    /**
     * @return string
     */
    public function getMethod();
}
