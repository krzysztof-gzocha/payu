<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\HttpStatusParser;

use Buzz\Message\Response;

/**
 * This class is checking the HTTP status code of the response from PayU.
 * If status code will be different then expected it will throw {@link HttpStatusParserException}
 *
 * Interface HttpStatusParserInterface
 * @package Team3\PayU\Communication\HttpStatusParser
 */
interface HttpStatusParserInterface
{
    /**
     * @param Response $curlResponse
     *
     * @throws HttpStatusParserException
     */
    public function parse(Response $curlResponse);
}
