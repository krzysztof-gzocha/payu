<?php
namespace Team3\Order\Transformer\UserOrder\Strategy\ShippingMethod;

use Team3\Order\PropertyExtractor\Extractor;
use Team3\Order\PropertyExtractor\ExtractorInterface;
use Team3\Order\PropertyExtractor\Reader\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationReader as DoctrineAnnotationReader;
use tests\unit\Team3\Order\Transformer\UserOrder\Strategy\Model\UsersShippingModel;

/**
 * Class SingleShippingMethodTransformerTest
 * @package Team3\Order\Transformer\UserOrder\Strategy\ShippingMethod
 * @group money
 */
class SingleShippingMethodTransformerTest extends \Codeception\TestCase\Test
{
    /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var ExtractorInterface
     */
    protected $extractor;

    /**
     * @var SingleShippingMethodTransformer
     */
    protected $singleShippingMethodTransformer;

    protected function _before()
    {
        $this->extractor = new Extractor(
            new AnnotationReader(
                new DoctrineAnnotationReader()
            )
        );

        $this->singleShippingMethodTransformer = new SingleShippingMethodTransformer(
            $this->extractor
        );
    }

    public function testOnRealExample()
    {
        $shippingMethod = $this->singleShippingMethodTransformer->transform(
            new UsersShippingModel()
        );

        $this->assertInstanceOf(
            'Team3\Order\Model\ShippingMethods\ShippingMethodInterface',
            $shippingMethod
        );

        $this->assertNotEmpty($shippingMethod->getCountry());
        $this->assertNotEmpty($shippingMethod->getName());
        $this->assertNotEmpty($shippingMethod->getPrice());
    }
}
