<?php
namespace Team3\Order\Model;

use tests\unit\Team3\Order\Model\FilledModel;
use tests\unit\Team3\Order\Model\IsFilledModel;
use tests\unit\Team3\Order\Model\NotFilledModel;

class IsFilledTraitTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testIfReturnsGoodValues()
    {
        $model = new IsFilledModel(new FilledModel());
        $this->assertTrue($model->isFilled());

        $model = new IsFilledModel(null, "someProperty");
        $this->assertTrue($model->isFilled());

        $model = new IsFilledModel();
        $this->assertFalse($model->isFilled());

        $model = new IsFilledModel(new NotFilledModel());
        $this->assertFalse($model->isFilled());
    }
}
