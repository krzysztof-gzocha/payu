<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Response;

use Team3\PayU\Communication\Request\PayURequestInterface;

/**
 * Class OrderCreateResponse
 * @package Team3\PayU\Communication\Response
 */
interface ResponseInterface
{
    /**
     * @param PayURequestInterface $payURequest
     *
     * @return bool
     */
    public function supports(PayURequestInterface $payURequest);
}
