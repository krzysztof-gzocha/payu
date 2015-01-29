<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Response;

use Team3\PayU\Communication\Request\PayURequestInterface;

/**
 * Represents any response from PayU.
 * It is used with {@link RequestProcessInterface}
 *
 * Interface ResponseInterface
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
