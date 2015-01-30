<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\HttpStatusParser;

use Exception;
use Team3\PayU\Communication\Process\RequestProcessException;

/**
 * Will be thrown when HTTP status code returned from PayU will be different then expected.
 *
 * Class HttpStatusParserException
 * @package Team3\PayU\Communication\HttpStatusParser
 */
class HttpStatusParserException extends RequestProcessException
{
    /**
     * @var int
     */
    private $statusCode;

    /**
     * @param string    $message
     * @param int       $statusCode
     * @param Exception $previous
     */
    public function __construct(
        $message = "",
        $statusCode = 0,
        Exception $previous = null
    ) {
        parent::__construct($message, 0, $previous);
        $this->statusCode = $statusCode;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
