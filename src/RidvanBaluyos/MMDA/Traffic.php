<?php

namespace RidvanBaluyos\MMDA;

class Traffic
{
    CONST FEED_URL = 'http://mmdatraffic.interaksyon.com/livefeed/';

    public function load_traffic_data()
    {
        $xml = simplexml_load_string($this->request_data());

        $data = array();
        $traffic = array();

        foreach ($xml->channel->item as $item)
        {
            $item = get_object_vars($item);
            $title = $item['title'];
            $description = $item['description'];
            $pubDate = $item['pubDate'];

            list($highway, $segment, $direction) = explode('-', $title); //highway-segment-direction

            if (empty($traffic[$highway]))
                $traffic[$highway] = array();

            if (empty($traffic[$highway][$segment]))
                $traffic[$highway][$segment] = array();

            $traffic[$highway][$segment][$direction] = $description;
            $traffic[$highway][$segment]['pubDate'] = $pubDate;
        }

        return $traffic;
    }

    private function request_data()
    {
        $ch = curl_init();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::FEED_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
