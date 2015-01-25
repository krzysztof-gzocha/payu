<?php
namespace Team3\PayU\ValidatorBuilder;

/**
 * Class ValidatorBuilderTest
 * @package Team3\ValidatorBuilder
 * @group validator
 */
class ValidatorBuilderTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testIfValidatorBuilderWillReturnValidator()
    {
        $readerMock = $this->getMockBuilder('\Doctrine\Common\Annotations\Reader')->getMock();

        $validatorBuilder = new ValidatorBuilder();
        $validator = $validatorBuilder->getValidator($readerMock);

        $this->assertInstanceOf(
            '\Symfony\Component\Validator\Validator\ValidatorInterface',
            $validator
        );
    }
}
