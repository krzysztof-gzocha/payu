<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Annotation;

use Doctrine\Common\Annotations\Annotation\Target;

/**
 * This annotation will help to transform user order into library's order object.
 * Just put this annotation on any method and define it's propertyName to let library know
 * what this method will return. To see all possible propertyNames please look into
 * {@link \Team3\PayU\Order\Transformer\UserOrder\TransformerProperties}
 *
 * Class PayU
 * @package Team3\PayU\Annotation
 * @Annotation
 * @Target({"METHOD"})
 */
class PayU
{
    /**
     * @var string
     */
    public $propertyName;

    /**
     * @param array $values
     */
    public function __construct(array $values = [])
    {
        if (array_key_exists('propertyName', $values)) {
            $this->propertyName = $values['propertyName'];
        }
    }

    /**
     * @return string
     */
    public function getPropertyName()
    {
        return $this->propertyName;
    }
}
