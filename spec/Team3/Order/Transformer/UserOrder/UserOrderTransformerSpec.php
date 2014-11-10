<?php

namespace spec\Team3\Order\Transformer\UserOrder;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;
use \Team3\Order\Annotation\PayU;
use Team3\Order\Model\OrderInterface;
use Team3\Order\PropertyExtractor\ExtractorInterface;
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
        ExtractorInterface $extractor
    ) {
        $this->prophet = new Prophet();

        $extractor
            ->extract(new Argument\Token\AnyValuesToken())
            ->willReturn($this->getAnnotationsExtractorResults());

        $this->beConstructedWith($extractor);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Team3\Order\Transformer\UserOrder\UserOrderTransformer');
    }

    public function it_should_ask_strategies_if_they_support_annotation(
        OrderInterface $order,
        UserOrderTransformerStrategyInterface $strategy
    ) {
        $strategy
            ->supports($this->getPropertyName())
            ->shouldBeCalledTimes(1);

        $this->addStrategy($strategy);
        $this->transform($order, 1);
    }

    public function it_should_transform_if_strategy_supports(
        OrderInterface $order,
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
        $this->transform($order, 'users order');
    }

    public function it_should_not_transform_if_strategy_doesnt_supports(
        OrderInterface $order,
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
        $this->transform($order, 'users order');
    }

    protected function getAnnotationsExtractorResults()
    {
        $extractorResultProphecy = $this->prophet
            ->prophesize('Team3\\Order\\PropertyExtractor\\ExtractorResult');
        $extractorResultProphecy->getPropertyName()->willReturn($this->getPropertyName());
        $extractorResultProphecy->getValue()->willReturn($this->getValue());

        return [
            $extractorResultProphecy
        ];
    }

    protected function getValue()
    {
        return 123;
    }

    /**
     * @return PayU
     */
    protected function getPropertyName()
    {
        return 'propertyName';
    }
}
