<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\SignatureCalculator\Validator;

use Team3\PayU\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;

/**
 * Will transform signature string to {@link AlgorithmInterface} object.
 *
 * Interface AlgorithmExtractorInterface
 * @package Team3\PayU\SignatureCalculator\Validator
 */
interface AlgorithmExtractorInterface
{
    /**
     * @param string               $signature
     * @param AlgorithmInterface[] $algorithms
     *
     * @throws AlgorithmExtractorException
     * @return AlgorithmInterface
     */
    public function extractAlgorithm($signature, array $algorithms);
}
