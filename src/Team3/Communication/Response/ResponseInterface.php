<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Communication\Response;

use Team3\Communication\Request\PayURequestInterface;

/**
 * Class OrderCreateResponse
 * @package Team3\Communication\Response
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
