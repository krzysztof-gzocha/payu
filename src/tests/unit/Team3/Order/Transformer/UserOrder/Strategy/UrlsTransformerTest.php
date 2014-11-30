<?php
namespace Team3\Order\Transformer\UserOrder\Strategy;

use Team3\Order\Model\Order;
use Team3\Order\Model\OrderInterface;
use Team3\PropertyExtractor\Extractor;
use Team3\PropertyExtractor\ExtractorInterface;
use Team3\PropertyExtractor\ExtractorResult;
use Team3\PropertyExtractor\Reader\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationReader as DoctrineAnnotationReader;
use tests\unit\Team3\Order\Transformer\UserOrder\Strategy\Model\UserOrderModelWithPrivateMethods;

class UrlsTransformerTest extends \Codeception\TestCase\Test
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
     * @var UrlsTransformer
     */
    protected $urlsTransformer;

    protected function _before()
    {
        $this->extractor = new Extractor(
            new AnnotationReader(
                new DoctrineAnnotationReader()
            )
        );

        $this->urlsTransformer = new UrlsTransformer();
    }

    public function testIfSupportsOnlyCertainParameterName()
    {
        $this->assertTrue(
            $this->urlsTransformer->supports('url.test')
        );
        $this->assertFalse(
            $this->urlsTransformer->supports('non-url.test')
        );
        $this->assertFalse(
            $this->urlsTransformer->supports('url.')
        );
    }

    public function testIfAllValuesAreCopied()
    {
        $order = new Order();
        $userOrder = new UserOrderModelWithPrivateMethods();

        $this->copyAllValues($order, $userOrder);
        $this->assertNotEmpty($order->getContinueUrl());
        $this->assertNotEmpty($order->getNotifyUrl());
        $this->assertNotEmpty($order->getOrderUrl());
    }

    /**
     * @param OrderInterface                   $order
     * @param UserOrderModelWithPrivateMethods $userOrder
     */
    private function copyAllValues(
        OrderInterface $order,
        UserOrderModelWithPrivateMethods $userOrder
    ) {
        $results = $this
            ->extractor
            ->extract($userOrder);

        /** @var ExtractorResult $result */
        foreach ($results as $result) {
            if ($this->urlsTransformer->supports($result->getPropertyName())) {
                $this->urlsTransformer->transform(
                    $order,
                    $result
                );
            }
        }
    }
}
