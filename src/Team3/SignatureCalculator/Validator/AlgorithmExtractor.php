<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\SignatureCalculator\Validator;

use Team3\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;

class AlgorithmExtractor implements AlgorithmExtractorInterface
{
    /**
     * Will extract one algorithm name from signature header and
     * search for algorithm with the same name in array passed as 2 parameter.
     * If there is no algorithm with this name will throw exception.
     *
     * @param string               $signatureHeader
     * @param AlgorithmInterface[] $algorithms      array of algorithms to search
     *
     * @throws AlgorithmExtractorException
     * @return AlgorithmInterface
     */
    public function extractAlgorithm($signatureHeader, array $algorithms)
    {
        $algorithmName = $this->extractAlgorithmString($signatureHeader);

        foreach ($algorithms as $algorithm) {
            if ($this->isNameEqual($algorithmName, $algorithm)) {
                return $algorithm;
            }
        }

        throw new AlgorithmExtractorException(sprintf(
            'There is no algorithm with name %s.',
            $algorithmName
        ));
    }

    /**
     * @param string $signatureHeader
     *
     * @return string
     * @throws AlgorithmExtractorException
     */
    private function extractAlgorithmString($signatureHeader)
    {
        $matches = [];
        preg_match('/algorithm=([a-zA-Z0-9]+);/', $signatureHeader, $matches);
        if (array_key_exists(1, $matches)) {
            return $matches[1];
        }

        throw new AlgorithmExtractorException(sprintf(
            'Could not extract algorithm name from string "%s"',
            $signatureHeader
        ));
    }

    /**
     * @param string             $name
     * @param AlgorithmInterface $algorithm
     *
     * @return bool
     */
    private function isNameEqual($name, AlgorithmInterface $algorithm)
    {
        return 0 === strcasecmp($name, $algorithm->getName());
    }
}
