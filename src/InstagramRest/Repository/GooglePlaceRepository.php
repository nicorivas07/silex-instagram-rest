<?php
namespace InstagramRest\Repository;

use Silex\Application;
use GuzzleHttp;

/**
 * Google Place Repository
 */
class GooglePlaceRepository implements GooglePlaceInterface
{
    /**
     * Google API url
     * @var string
     */
    protected $google_url;

    /**
     * Google API key
     * @var string
     */
    protected $google_key;

    /**
     * Constructor of the class
     *
     * @param string $google_url
     * @param string $google_key
     */
    public function __construct($google_url, $google_key)
    {
        $this->google_url = $google_url;
        $this->google_key = $google_key;
    }

    /**
     * Get
     *
     * @param float $latitude
     * @param float $longitude
     * @return array || null $response
     */
    public function get($latitude, $longitude)
    {
        $response = array (
            'reference' => null,
            'address' => null
        );
        try {
            $client = new GuzzleHttp\Client();
            $resource = $client->get(
                $this->google_url, array(
                    'query' => array(
                        'key' =>  $this->google_key,
                        'location' => $latitude . ',' . $longitude,
                        'radius' => 1
                    )
                )
            );
        } catch (Exception $e) {
            $response = array (
                'reference' => 'No data available',
                'address' => 'No data available'
            );
        }
        if (!empty($data = $resource->getBody())) {
            $data = json_decode($data);
            if (
                !empty($data->results[0]->name) &&
                !empty($data->results[0]->vicinity)
            ) {
                $response = array (
                    'reference' => $data->results[0]->name,
                    'address' => $data->results[0]->vicinity
                );
            }
        }
        return $response;
    }
}
