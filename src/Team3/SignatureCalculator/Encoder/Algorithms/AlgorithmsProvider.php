<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\SignatureCalculator\Encoder\Algorithms;

class AlgorithmsProvider implements AlgorithmsProviderInterface
{
    /**
     * @return AlgorithmInterface[]
     */
    public function getAlgorithms()
    {
        return [
            new Md5Algorithm(),
            new Sha1Algorithm(),
            new Sha256Algorithm()
        ];
    }
}
