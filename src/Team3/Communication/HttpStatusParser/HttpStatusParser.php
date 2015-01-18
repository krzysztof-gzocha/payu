<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Communication\HttpStatusParser;

use Buzz\Message\Response;

class HttpStatusParser implements HttpStatusParserInterface
{
    const SUCCESS_CODE = 200;

    /**
     * @param Response $curlResponse
     *
     * @throws HttpStatusParserException
     */
    public function parse(Response $curlResponse)
    {
        $statusCode = $curlResponse->getStatusCode();

        if (self::SUCCESS_CODE !== $statusCode) {
            throw new HttpStatusParserException(
                $curlResponse->getContent(),
                $statusCode
            );
        }
    }
}
