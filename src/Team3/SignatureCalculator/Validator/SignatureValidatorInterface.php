<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\SignatureCalculator\Validator;

use Team3\Configuration\Credentials\CredentialsInterface;
use Team3\SignatureCalculator\SignatureCalculatorException;

interface SignatureValidatorInterface
{
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
    );
}
