<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\SignatureCalculator\Encoder\Algorithms;

class Md5Algorithm extends AbstractAlgorithm
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'MD5';
    }
}
