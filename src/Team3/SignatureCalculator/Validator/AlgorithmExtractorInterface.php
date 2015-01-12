<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\SignatureCalculator\Validator;

use Team3\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;

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
