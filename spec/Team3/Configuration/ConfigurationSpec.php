<?php

namespace spec\Team3\Configuration;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConfigurationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this
            ->shouldHaveType('Team3\Configuration\Configuration');
    }

    function it_returns_complete_api_url()
    {
        $this
            ->getAPIUrl()
            ->shouldReturn('https://payu.com/api/v2_1');
    }
}
