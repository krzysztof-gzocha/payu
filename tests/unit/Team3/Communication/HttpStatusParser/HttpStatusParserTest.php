<?php
namespace Team3\Communication\HttpStatusParser;


class HttpStatusParserTest extends \Codeception\TestCase\Test
{
    const RESPONSE_MESSAGE = 'Response message';
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testNoException()
    {
        $parser = new HttpStatusParser();

        $parser->parse($this->getCurlResponse(200));
    }

    /**
     * @throws HttpStatusParserException
     */
    public function testException()
    {
        $parser = new HttpStatusParser();

        try {
            $parser->parse($this->getCurlResponse(500));
        } catch (HttpStatusParserException $exception) {
            $this->assertEquals(
                500,
                $exception->getStatusCode()
            );

            $this->assertEquals(
                self::RESPONSE_MESSAGE,
                $exception->getMessage()
            );

            return;
        }

        $this->fail('Exception should be thrown');
    }

    /**
     * @return \Buzz\Message\Response
     */
    private function getCurlResponse($statusCode)
    {
        $response = $this
            ->getMockBuilder('\Buzz\Message\Response')
            ->disableOriginalConstructor()
            ->getMock();

        $response
            ->expects($this->any())
            ->method('getStatusCode')
            ->willReturn($statusCode);

        $response
            ->expects($this->any())
            ->method('getContent')
            ->willReturn(self::RESPONSE_MESSAGE);

        return $response;
    }
}
