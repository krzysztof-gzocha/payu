<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Process;

use Team3\PayU\Communication\Request\PayURequestInterface;
use Team3\PayU\Communication\Response\ResponseInterface;
use Team3\PayU\Configuration\ConfigurationInterface;

interface RequestProcessInterface
{
    /**
     * @param PayURequestInterface   $payURequest
     * @param ConfigurationInterface $configuration
     *
     * @return object
     */
    public function process(
        PayURequestInterface $payURequest,
        ConfigurationInterface $configuration
    );

    /**
     * @return $this
     */
    public function disableValidation();

    /**
     * @param ResponseInterface $response
     *
     * @return $this
     */
    public function addResponse(ResponseInterface $response);
}
