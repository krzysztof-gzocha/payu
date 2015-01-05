<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\Communication\Process;

use Team3\Communication\Request\PayURequestInterface;
use Team3\Communication\Response\ResponseInterface;
use Team3\Configuration\ConfigurationInterface;

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
