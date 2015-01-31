<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Request;

use Team3\PayU\Serializer\SerializableInterface;

/**
 * It is used to represent all request that can be send to PayU.
 * It is not any form of cURL request.
 * It collect informations about method, path and data.
 * Note that path is not absolute here.
 *
 * Interface PayURequestInterface
 * @package Team3\PayU\Communication\Request
 */
interface PayURequestInterface
{
    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';
    const METHOD_DELETE = 'DELETE';

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
