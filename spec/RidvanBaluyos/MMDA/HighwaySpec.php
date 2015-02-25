<?php

namespace spec\RidvanBaluyos\MMDA;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HighwaySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('RidvanBaluyos\MMDA\Highway');
    }

    /**
     * @param RidvanBaluyos\MMDA\Traffic $traffic
     */
    function let($traffic)
    {
        $this->beConstructedWith($traffic);
        $traffic->load_traffic_data();
    }

    function it_can_get_traffic_from_highway($traffic)
    {
        $traffic->load_traffic_data();
        $this->get_traffic('hignway', 'segment')->shouldReturn(NULL);
    }

    function it_can_get_a_list_of_highways($traffic)
    {
        $traffic->load_traffic_data();
        $this->get_list();
    }
}
