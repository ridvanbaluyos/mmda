<?php namespace Ridvanbaluyos\Mmda;

class MMDA
{
    CONST FEED_URL = 'http://mmdatraffic.interaksyon.com/livefeed/';

    private $trafficData;
    private $channel;

    public function __construct()
    {
        $this->trafficData = $this->getTrafficData();
    }

    public function traffic($highway, $segment = NULL)
    {
        $traffic = $this->trafficData[$highway];

        if ($segment)
            $traffic = $traffic[$segment];

        return $traffic;
    }

    public function get_highways()
    {
        if ($this->trafficData)
            return array_keys($this->trafficData);

        return null;
    }

    public function get_highway_segments($highway = NULL)
    {
        if ($highway && isset($this->trafficData[$highway]))
            return array_keys($this->trafficData[$highway]);

        return null;
    }

    final private function getTrafficData()
    {
        $ch = curl_init();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::FEED_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $xml = simplexml_load_string($response);

        return $this->parseTrafficData($xml);
    }

    final private function parseTrafficData($xml)
    {
        $data = array();
        $traffic = array();

        foreach ($xml->channel->item as $item) {
            $item = get_object_vars($item);
            $title = $item['title'];
            $description = $item['description'];
            $pubDate = $item['pubDate'];

            list($highway, $segment, $direction) = explode('-', $title); //highway-segment-direction

            if (empty($traffic[$highway])) $traffic[$highway] = array();
            if (empty($traffic[$highway][$segment])) $traffic[$highway][$segment] = array();

            $traffic[$highway][$segment][$direction] = $description;
            $traffic[$highway][$segment]['pubDate'] = $pubDate;
        }

        return $traffic;
    }
}
