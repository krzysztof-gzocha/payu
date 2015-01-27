<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\SignatureCalculator\Validator;

use Team3\PayU\Configuration\Credentials\CredentialsInterface;
use Team3\PayU\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;
use Team3\PayU\SignatureCalculator\Encoder\Algorithms\AlgorithmsProviderInterface;
use Team3\PayU\SignatureCalculator\SignatureCalculatorException;
use Team3\PayU\SignatureCalculator\SignatureCalculatorInterface;

class SignatureValidator implements SignatureValidatorInterface
{
    /**
     * @var SignatureCalculatorInterface
     */
    private $signatureCalculator;

    /**
     * @var AlgorithmExtractorInterface
     */
    private $algorithmExtractor;

    /**
     * @var AlgorithmsProviderInterface
     */
    private $algorithmsProvider;

    /**
     * @param SignatureCalculatorInterface $signatureCalculator
     * @param AlgorithmExtractorInterface  $algorithmExtractor
     * @param AlgorithmsProviderInterface  $algorithmsProvider
     */
    public function __construct(
        SignatureCalculatorInterface $signatureCalculator,
        AlgorithmExtractorInterface $algorithmExtractor,
        AlgorithmsProviderInterface $algorithmsProvider
    ) {
        $this->signatureCalculator = $signatureCalculator;
        $this->algorithmExtractor = $algorithmExtractor;
        $this->algorithmsProvider = $algorithmsProvider;
    }

    /**
     * @param string               $data
     * @param string               $signatureHeader
     * @param CredentialsInterface $credentials
     *
     * @return bool
     * @throws SignatureCalculatorException
     */
    public function isSignatureValid(
        $data,
        $signatureHeader,
        CredentialsInterface $credentials
    ) {
        $calculatedSignature = $this
            ->signatureCalculator
            ->calculate(
                json_decode($data, true),
                $credentials,
                $this->extractAlgorithm($signatureHeader)
            );

        return $this->compareSignatureStrings(
            $calculatedSignature,
            $this->extractSignature($signatureHeader)
        );
    }

    /**
     * @param string $signature
     *
     * @return string
     * @throws SignatureValidatorException
     */
    private function extractSignature($signature)
    {
        $matches = [];
        preg_match('/signature=([a-zA-Z0-9]+);/', $signature, $matches);
        if (!array_key_exists(1, $matches)) {
            throw new SignatureValidatorException(sprintf(
                'Could not extract signature from string %s',
                $signature
            ));
        }

        return $matches[1];
    }

    /**
     * @param string $signature
     *
     * @return AlgorithmInterface
     */
    private function extractAlgorithm($signature)
    {
        return $this
            ->algorithmExtractor
            ->extractAlgorithm($signature, $this->algorithmsProvider->getAlgorithms());
    }

    /**
     * @param string $firstSignature
     * @param string $secondSignature
     *
     * @return bool
     */
    private function compareSignatureStrings($firstSignature, $secondSignature)
    {
        return 0 === strcasecmp($firstSignature, $secondSignature);
    }
}
