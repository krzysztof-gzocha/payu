<?php
namespace Team3\Communication\Response\Model;


use Team3\Order\Model\Money\Money;

class RefundModelTest extends \Codeception\TestCase\Test
{
    const DESCRIPTION = 'Description';
    const CREATION_DATE_TIME = '24.01.2014 15:01:35';
    const CURRENCY_CODE = 'PLN';
    const EXT_REFUND_ID = '123456';
    const REFUND_ID = '987654';
    const STATUS_DATE_TIME = '01.01.2014 10:10:10';
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testPostDeserialize()
    {
        $refundModel = new RefundModel();
        $refundModel
            ->setAmount(1000)
            ->setCurrencyInAmount();
        $this->assertEquals(
            '10',
            (string) $refundModel->getAmount()
        );
        $refundModel
            ->setCurrencyCode('PLN')
            ->setCurrencyInAmount();
        $this->assertEquals(
            '10 PLN',
            (string) $refundModel->getAmount()
        );
    }

    public function testFinalizeStatus()
    {
        $refundModel = new RefundModel();
        $refundModel->setStatus(RefundModelInterface::STATUS_FINALIZED);
        $this->assertTrue($refundModel->isFinalized());
        $this->assertFalse($refundModel->isPending());
        $this->assertFalse($refundModel->isCanceled());
    }

    public function testPendingStatus()
    {
        $refundModel = new RefundModel();
        $refundModel->setStatus(RefundModelInterface::STATUS_PENDING);
        $this->assertFalse($refundModel->isFinalized());
        $this->assertTrue($refundModel->isPending());
        $this->assertFalse($refundModel->isCanceled());
    }

    public function testCancelStatus()
    {
        $refundModel = new RefundModel();
        $refundModel->setStatus(RefundModelInterface::STATUS_CANCELED);
        $this->assertFalse($refundModel->isFinalized());
        $this->assertFalse($refundModel->isPending());
        $this->assertTrue($refundModel->isCanceled());
    }

    public function testGettersAndSetters()
    {
        $refundModel = new RefundModel();
        $refundModel
            ->setDescription(self::DESCRIPTION)
            ->setAmount(10000)
            ->setCreationDateTime(self::CREATION_DATE_TIME)
            ->setCurrencyCode(self::CURRENCY_CODE)
            ->setExtRefundId(self::EXT_REFUND_ID)
            ->setRefundId(self::REFUND_ID)
            ->setStatus(RefundModelInterface::STATUS_FINALIZED)
            ->setStatusDateTime(self::STATUS_DATE_TIME);

        $this->assertEquals(
            self::DESCRIPTION,
            $refundModel->getDescription()
        );
        $this->assertInstanceOf(
            'Team3\Order\Model\Money\MoneyInterface',
            $refundModel->getAmount()
        );
        $this->assertEquals(
            (new Money(100))->getValue(),
            $refundModel->getAmount()->getValue()
        );
        $this->assertEquals(
            new \DateTime(self::CREATION_DATE_TIME),
            $refundModel->getCreationDateTime()
        );
        $this->assertEquals(
            self::CURRENCY_CODE,
            $refundModel->getCurrencyCode()
        );
        $this->assertEquals(
            self::EXT_REFUND_ID,
            $refundModel->getExtRefundId()
        );
        $this->assertEquals(
            self::REFUND_ID,
            $refundModel->getRefundId()
        );
        $this->assertEquals(
            RefundModelInterface::STATUS_FINALIZED,
            $refundModel->getStatus()
        );
        $this->assertEquals(
            new \DateTime(self::STATUS_DATE_TIME),
            $refundModel->getStatusDateTime()
        );
    }
}
