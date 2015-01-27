<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\HttpStatusParser;

use Exception;
use Team3\PayU\Communication\Process\RequestProcessException;

class HttpStatusParserException extends RequestProcessException
{
    /**
     * @var int
     */
    private $statusCode;

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
