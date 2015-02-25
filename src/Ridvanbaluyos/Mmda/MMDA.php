<?php namespace Ridvanbaluyos\Mmda;

class MMDA
{
    private $trafficData;
    private $channel;

    public function __construct($mustInit = false)
    {
        $this->trafficData = $this->getTrafficData();
    }

    public function traffic()
    {
        if (isset($this->trafficData)) {
            return $this->trafficData;
        } else {
            return null;
        }
    }

    public function highways()
    {
        if (isset($this->trafficData)) {
            return array_keys($this->trafficData);
        } else {
            return null;
        }
    }

    public function segments($highway = '')
    {
        if (isset($this->trafficData[$highway])) {
            return array_keys($this->trafficData[$highway]);
        } else {
            return null;
        }

    }

    final private function getTrafficData()
    {
        $ch = curl_init();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://mmdatraffic.interaksyon.com/livefeed/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $xml = simplexml_load_string($response);

        $array = $this->parseTrafficData($xml);

        return $array;
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
