<?php
/**
 * Controller for Instagram resource
 *
 * @author Nicolas Rivas <nicolasrivas07@gmail.com>
 */
namespace InstagramRest\Controller;

use Silex\Application;
use InstagramRest\Repository\InstagramRepository;
use InstagramRest\Repository\GooglePlaceRepository;

class InstagramController
{
    /**
     * InstagramRest\Repository\InstagramRepository
     *
     * @var Instagram
     */
    protected $instagram;

    /**
     * InstagramRest\Repository\GooglePlaceRepository
     *
     * @var Google
     */
    protected $google;

    /**
     * Constructor of the class
     *
     * @param InstagramRepository $instagram
     * @param GooglePlaceRepository $google
     */
    public function __construct(
        InstagramRepository $instagram,
        GooglePlaceRepository $google
    )
    {
        $this->instagram = $instagram;
        $this->google = $google;
    }

    /**
     * index display media location data
     *
     * @param  int $media_id
     * @param  Application $app
     * @return array $response
     */
    public function indexAction($media_id, Application $app) {
        $v = $this->instagram->validateMedia($media_id);
        if ($v['status'] === 200) {
            $response = self::locationGenerator($media_id, $v['location']);
        } else {
            $response = $v['error'];
        }
        //return Response::json($response, $v['status']);
        return $app->json($response, $v['status']);
    }

    /**
     * locationGenerator with the coordinates data, it connects to
     * Google Place API for get more information about location.
     * This function builds a location array ready to be listed.
     *
     * @param  int    $media_id
     * @param  array  $location
     * @return array  response
     *         int    response[id] instagram media id
     *         array  response[location][geopoint] coordinates
     *         string response[location][reference] coordinate reference
     *         provides by google
     *         string response[location][address] coordinate address
     *         provides by google
     *         int    response[location][id] instragram location id
     *         string response[location][name] instragram location name
     */
    private function locationGenerator($media_id, $location)
    {
        $response = array(
            'id' => $media_id,
            'location' => null
        );

        if (!empty($location->latitude) && !empty($location->longitude)) {
            $google_data = $this->google->get(
                $location->latitude, $location->longitude
            );
            $response['location'] = array(
                'geopoint' => array(
                    'latitude' => $location->latitude,
                    'longitude' => $location->longitude
                ),
                'reference' => $google_data['reference'],
                'address' => $google_data['address']
            );
        }
        if (!empty($location->id)) {
            $response['location']['id'] = $location->id;
        }
        if (!empty($location->name)) {
            $response['location']['name'] = $location->name;
        }

        return $response;
    }
}