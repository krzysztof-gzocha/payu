<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\Communication\Process;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Team3\PayU\Communication\ClientInterface;
use Team3\PayU\Communication\HttpStatusParser\HttpStatusParser;
use Team3\PayU\Communication\HttpStatusParser\HttpStatusParserException;
use Team3\PayU\Communication\HttpStatusParser\HttpStatusParserInterface;
use Team3\PayU\Communication\Process\ResponseDeserializer\ResponseDeserializerInterface;
use Team3\PayU\Communication\Request\PayURequestInterface;
use Team3\PayU\Communication\Response\ResponseInterface;
use Team3\PayU\Configuration\ConfigurationInterface;
use Team3\PayU\Serializer\SerializableInterface;

/**
 * Class RequestProcess
 * @package Team3\PayU\Communication\Process
 */
class RequestProcess implements RequestProcessInterface
{
    /**
     * @var ResponseDeserializerInterface
     */
    private $responseDeserializer;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var HttpStatusParserInterface
     */
    private $httpStatusParser;

    /**
     * @var bool
     */
    private $shouldValidate;

    /**
     * @param ResponseDeserializerInterface $responseDeserializer
     * @param ClientInterface               $client
     * @param ValidatorInterface            $validator
     * @param HttpStatusParserInterface     $httpStatusParser
     */
    public function __construct(
        ResponseDeserializerInterface $responseDeserializer,
        ClientInterface $client,
        ValidatorInterface $validator,
        HttpStatusParserInterface $httpStatusParser
    ) {
        $this->responseDeserializer = $responseDeserializer;
        $this->client = $client;
        $this->validator = $validator;
        $this->httpStatusParser = $httpStatusParser;
        $this->shouldValidate = true;
    }

    /**
     * @param PayURequestInterface   $payURequest
     * @param ConfigurationInterface $configuration
     *
     * @return object
     * @throws HttpStatusParserException         when status code is not 200
     * @throws InvalidRequestDataObjectException when request data object is invalid
     */
    public function process(
        PayURequestInterface $payURequest,
        ConfigurationInterface $configuration
    ) {
        if ($this->shouldValidate) {
            $this->validate($payURequest->getDataObject());
        }

        $curlResponse = $this->client->sendRequest($configuration, $payURequest);
        $this->httpStatusParser->parse($curlResponse);

        return $this->responseDeserializer->deserializeResponse($curlResponse, $payURequest);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return $this
     */
    public function addResponse(ResponseInterface $response)
    {
        $this->responseDeserializer->addResponse($response);

        return $this;
    }

    /**
     * @return $this
     */
    public function disableValidation()
    {
        $this->shouldValidate = false;

        return $this;
    }

    /**
     * @param SerializableInterface $object
     *
     * @throws InvalidRequestDataObjectException
     */
    private function validate(SerializableInterface $object)
    {
        $violations = $this->validator->validate($object);

        if (0 < $violations->count()) {
            throw new InvalidRequestDataObjectException(
                $violations,
                sprintf(
                    'Given object %s in PayU request is invalid. %d violations are in this exception.',
                    get_class($object),
                    $violations->count()
                )
            );
        }
    }
}
