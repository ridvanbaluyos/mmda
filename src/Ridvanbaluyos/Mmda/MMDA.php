<?php 

namespace Ridvanbaluyos\Mmda;

/**
 * Metro Manila Development Authority - Traffic Data
 * http://mmdatraffic.interaksyon.com/livefeed/
 *
 * @package    MMDA Traffic Data
 * @author     Ridvan Baluyos <ridvan@baluyos.net>
 * @link       https://github.com/ridvanbaluyos/mmda
 * @license    MIT
 */
class MMDA
{
    const FEED_URL = 'http://mmdatraffic.interaksyon.com/livefeed/';

    private $trafficData;
    private $channel;

    /**
     * MMDA constructor.
     */
    public function __construct()
    {
        $this->trafficData = $this->getTrafficData();
    }

    /**
     * This function retrieves the traffic data.
     * @return array
     */
    public function traffic()
    {
        $traffic = $this->trafficData;

        return $traffic;
    }

    /**
     * This function returns the list of highways.
     *
     * @return array|null
     */
    public function highways()
    {
        if ($this->trafficData) {
            return array_keys($this->trafficData);
        }

        return null;
    }

    /**
     * This function returns the list of segments in a given highway.
     *
     * @param $highway
     * @return array|null
     */
    public function segments($highway = NULL)
    {
        if ($highway && isset($this->trafficData[$highway])) {
            return array_keys($this->trafficData[$highway]);
        }

        return null;
    }

    /**
     * This function retrieves the traffic data from the MMDA Traffic API.
     *
     * @return array
     */
    final private function getTrafficData()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::FEED_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $xml = simplexml_load_string($response);

        return $this->parseTrafficData($xml);
    }

    /**
     * This function parses the XML response from the MMDA Traffic API into JSON.
     *
     * @param $xml
     * @return array
     */
    final private function parseTrafficData($xml)
    {
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