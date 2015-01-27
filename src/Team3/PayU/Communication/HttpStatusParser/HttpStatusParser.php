<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\HttpStatusParser;

use Buzz\Message\Response;

class HttpStatusParser implements HttpStatusParserInterface
{
    const SUCCESS_CODE = 200;
    const REDIRECT_CODE = 302;

    /**
     * @param Response $curlResponse
     *
     * @throws HttpStatusParserException
     */
    public function parse(Response $curlResponse)
    {
        $statusCode = $curlResponse->getStatusCode();

        if ($this->shouldThrowException($statusCode)) {
            throw new HttpStatusParserException(
                $curlResponse->getContent(),
                $statusCode
            );
        }
    }

    /**
     * @param int $statusCode
     *
     * @return bool
     */
    private function shouldThrowException($statusCode)
    {
        return self::SUCCESS_CODE !== $statusCode
            && self::REDIRECT_CODE !== $statusCode;
    }
}
