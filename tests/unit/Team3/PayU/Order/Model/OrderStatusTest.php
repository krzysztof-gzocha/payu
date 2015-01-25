<?php
namespace Team3\PayU\Order\Model;

/**
 * Class OrderStatusTest
 * @package Team3\PayU\Order\Model
 * @group status
 */
class OrderStatusTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testEmpty()
    {
        $status = new OrderStatus();
        $this->assertTrue($status->isEmpty());
    }

    public function testCompleted()
    {
        $status = new OrderStatus('COMPLETED');
        $this->assertTrue($status->isCompleted());
    }

    public function testPending()
    {
        $status = new OrderStatus('PENDING');
        $this->assertTrue($status->isPending());
    }

    public function testCanceled()
    {
        $status = new OrderStatus('CANCELED');
        $this->assertTrue($status->isCanceled());
    }

    public function testWaitingForConfirmation()
    {
        $status = new OrderStatus('WAITING_FOR_CONFIRMATION');
        $this->assertTrue($status->isWaitingForConfirmation());
    }

    public function testNewStatus()
    {
        $status = new OrderStatus('NEW');
        $this->assertTrue($status->isNew());
    }

    public function testRejected()
    {
        $status = new OrderStatus('REJECTED');
        $this->assertTrue($status->isRejected());
    }
}
