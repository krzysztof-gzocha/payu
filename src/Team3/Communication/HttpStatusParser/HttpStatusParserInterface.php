<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Communication\HttpStatusParser;

use Buzz\Message\Response;

interface HttpStatusParserInterface
{
    /**
     * @param Response $curlResponse
     *
     * @throws HttpStatusParserException
     */
    public function parse(Response $curlResponse);
}
