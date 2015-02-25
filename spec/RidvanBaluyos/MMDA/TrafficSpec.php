<?php

namespace spec\RidvanBaluyos\MMDA;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TrafficSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('RidvanBaluyos\MMDA\Traffic');
    }

    function it_can_load_traffic_data()
    {
        $this->load_traffic_data();
    }
}
