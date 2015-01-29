<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\SignatureCalculator\Validator;

use Team3\PayU\Configuration\Credentials\CredentialsInterface;
use Team3\PayU\SignatureCalculator\SignatureCalculatorException;

/**
 * Will validate if given data is correctly signed for given credentials.
 *
 * Interface SignatureValidatorInterface
 * @package Team3\PayU\SignatureCalculator\Validator
 */
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
