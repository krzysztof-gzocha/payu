<?php

namespace spec\Team3\Order\Transformer\UserOrder;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;
use \Team3\Order\Annotation\Extractor\AnnotationsExtractorInterface;
use \Team3\Order\Annotation\PayU;
use \Team3\Order\Transformer\UserOrder\Strategy\UserOrderTransformerStrategyInterface;
use Team3\Order\Transformer\UserOrder\UserOrderTransformer;

/**
 * Class UserOrderTransformerSpec
 * @package spec\Team3\Order\Transformer\UserOrder
 * @mixin UserOrderTransformer
 */
class UserOrderTransformerSpec extends ObjectBehavior
{
    /**
     * @var Prophet
     */
    private $prophet;

    public function let(
        AnnotationsExtractorInterface $annotationsExtractor
    ) {
        $this->prophet = new Prophet();

        $annotationsExtractor
            ->extract(new Argument\Token\AnyValuesToken())
            ->willReturn($this->getAnnotationsExtractorResults());

        $this->beConstructedWith($annotationsExtractor);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Team3\Order\Transformer\UserOrder\UserOrderTransformer');
    }

    public function it_should_ask_strategies_if_they_support_annotation(
        UserOrderTransformerStrategyInterface $strategy
    ) {
        $strategy
            ->supports($this->getAnnotation())
            ->shouldBeCalledTimes(1);

        $this->addStrategy($strategy);
        $this->transform(1);
    }

    public function it_should_transform_if_strategy_supports(
        UserOrderTransformerStrategyInterface $strategy
    ) {
        $strategy
            ->supports(new Argument\Token\AnyValuesToken())
            ->willReturn(true);

        $strategy
            ->transform(
                new Argument\Token\AnyValuesToken(),
                new Argument\Token\AnyValuesToken()
            )
            ->shouldBeCalledTimes(1);

        $this->addStrategy($strategy);
        $this->transform('users order');
    }

    public function it_should_not_transform_if_strategy_doesnt_supports(
        UserOrderTransformerStrategyInterface $strategy
    ) {
        $strategy
            ->supports(new Argument\Token\AnyValuesToken())
            ->willReturn(false);

        $strategy
            ->transform(
                new Argument\Token\AnyValuesToken(),
                new Argument\Token\AnyValuesToken()
            )
            ->shouldBeCalledTimes(0);

        $this->addStrategy($strategy);
        $this->transform('users order');
    }

    protected function getAnnotationsExtractorResults()
    {
        $extractorResultProphecy = $this->prophet
            ->prophesize('Team3\\Order\\Annotation\\Extractor\\AnnotationsExtractorResult');
        $extractorResultProphecy->getAnnotation()->willReturn($this->getAnnotation());
        $extractorResultProphecy->getReflectionMethod()->willReturn($this->getReflectionMethod());

        return [
            $extractorResultProphecy
        ];
    }

    protected function getReflectionMethod()
    {
        return $this->prophet
            ->prophesize('\ReflectionMethod');
    }

    /**
     * @return PayU
     */
    protected function getAnnotation()
    {
        return new PayU();
    }
}
