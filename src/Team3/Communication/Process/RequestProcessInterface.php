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
     * @param bool                   $shouldValidate
     *
     * @return object
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function process(
        PayURequestInterface $payURequest,
        ConfigurationInterface $configuration,
        $shouldValidate = true
    );

    /**
     * @param ResponseInterface $response
     *
     * @return $this
     */
    public function addResponse(ResponseInterface $response);

    /**
     * @param ResponseInterface[] $responses
     *
     * @return $this
     */
    public function setResponses(array $responses);
}
