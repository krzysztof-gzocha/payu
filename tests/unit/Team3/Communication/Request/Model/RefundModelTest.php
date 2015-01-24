<?php
namespace Team3\Communication\Request\Model;


class RefundModelTest extends \Codeception\TestCase\Test
{
    const NEW_DESC = 'New description';
    const BANK_DESC = 'New bank description';
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testSetters()
    {
        $refundModel = new RefundModel(
            'Description'
        );

        $this->assertInstanceOf(
            '\Team3\Communication\Request\Model\RefundModel',
            $refundModel->setDescription(self::NEW_DESC)
        );
        $this->assertInstanceOf(
            '\Team3\Communication\Request\Model\RefundModel',
            $refundModel->setBankDescription(self::BANK_DESC)
        );
        $this->assertInstanceOf(
            '\Team3\Communication\Request\Model\RefundModel',
            $refundModel->setAmountFromDeserialization(1000)
        );

        $this->assertEquals(
            self::NEW_DESC,
            $refundModel->getDescription()
        );

        $this->assertEquals(
            self::BANK_DESC,
            $refundModel->getBankDescription()
        );

        $this->assertEquals(
            10,
            $refundModel->getAmount()->getValue()
        );
    }
}
