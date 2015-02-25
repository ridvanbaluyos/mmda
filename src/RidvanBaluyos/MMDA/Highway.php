<?php

namespace RidvanBaluyos\MMDA;

class Highway
{
    private $traffic_data;

    public function __construct(Traffic $traffic)
    {
        $this->traffic_data = $traffic->load_traffic_data();
    }

    public function get_traffic($highway, $segment = NULL)
    {
        $traffic = $this->traffic_data[$highway];

        if ($segment)
            $traffic = $traffic[$segment];

        return $traffic;
    }

    public function get_list()
    {
        if ($this->traffic_data)
            return array_keys($this->traffic_data);

        return NULL;
    }
}
