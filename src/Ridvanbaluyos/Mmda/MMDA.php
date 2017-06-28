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

        return $this->sanitizeTrafficData($this->parseTrafficData($xml));
    }

    /**
     * This function parses the XML response from the MMDA Traffic API into JSON.
     *
     * @param $xml
     * @return array
     */
    final private function parseTrafficData($xml)
    {
        $traffic = [];

        foreach ($xml->channel->item as $item) {
            $item = get_object_vars($item);
            $title = $item['title'];
            $description = $item['description'];
            $pubDate = $item['pubDate'];

            $highway = explode('-', $title, 2)[0];
            $segment = substr(explode('-', $title, 2)[1], 0, -3);
            $direction = substr(explode('-', $title, 2)[1], -2);

            if (empty($traffic[$highway])) $traffic[$highway] = [];
            if (empty($traffic[$highway][$segment])) $traffic[$highway][$segment] = [];

            $traffic[$highway][$segment][$direction] = $description;
            $traffic[$highway][$segment]['pubDate'] = $pubDate;
        }

        return $traffic;
    }

    /**
     * This function sanitizes the traffic data and organizes them into an envelope
     *
     * @param array $trafficData
     * @return array
     */
    final private function sanitizeTrafficData(Array $trafficData)
    {
        $traffic = [];
        foreach ($trafficData as $highway=>$segments) {
            $traffic[$highway] = [
                'name' => $highway,
                'label' => $this->convertToTitle($highway),
            ];
            $traffic[$highway]['segments'] = [];
            $dataSegments = [];

            foreach ($segments as $segment=>$status) {
                $dataSegments[$segment] = [
                    'name' => $segment,
                    'label' => $this->convertToTitle($segment),
                    'status' => $this->convertToStatus($status),
                    'last_updated' => $status['pubDate'],
                ];
                $traffic[$highway]['segments'] = $dataSegments;
            }
        }

        return $traffic;
    }

    /**
     * This function converts traffic data status to readable format.
     *
     * @param array $data
     * @return array
     */
    final private function convertToStatus(Array $data)
    {
        $statusMatrix = [
            'L' => 'Light',
            'ML' => 'Light to Moderate',
            'M' => 'Moderate',
            'MH' => 'Moderate to Heavy',
            'H' => 'Heavy'
        ];

        $status = [
            'NB' => [
                'name' => $data['NB'],
                'label' => $statusMatrix[$data['NB']] . ' Traffic',
            ],
            'SB' => [
                'name' => $data['SB'],
                'label' => $statusMatrix[$data['SB']] . ' Traffic',
            ]
        ];

        return $status;
    }

    /**
     * This function sanitizes certain abbreviations into readable format.
     *
     * @param $string
     * @return string
     */
    final private function convertToTitle($string)
    {
        $string2 = [];
        $string = str_replace(['_', 'AVE.', 'BLVD.'], [' ', 'AVENUE', 'BOULEVARD'], $string);
        $words = explode(' ', $string);

        foreach ($words as $word) {
            if (!in_array($word, ['EDSA', 'U.N.'])) {
                $word = ucwords(mb_strtolower($word));
            }
            array_push($string2, $word);
        }

        return implode(' ', $string2);
    }
}