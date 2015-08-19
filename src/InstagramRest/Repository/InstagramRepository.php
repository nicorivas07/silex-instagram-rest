<?php
namespace InstagramRest\Repository;

use MetzWeb\Instagram\Instagram;
use Silex\Application;

/**
 * Instagram repository
 */
class InstagramRepository implements InstagramInterface
{
    /**
     * Error API
     */
    const ERROR_API = "APINotFoundError";

    /**
     * Error API Message
     */
    const ERROR_API_MESSAGE = "invalid media id";

    /**
     * Data Null
     */
    const DATA_NULL = "Null";

    /**
     * Data Null Message
     */
    const DATA_NULL_MESSAGE = "No data available";

    /**
     * @var MetzWeb\Instagram\Instagram
     */
    protected $instagram;

    /**
     * Constructor of the class
     *
     * @param string $client_id
     */
    public function __construct($client_id)
    {
        $instagram = new Instagram($client_id);

        $this->instagram = $instagram;
    }

    /**
     * validateMedia it controls the input is numeric
     * and connect with Instagram API for location data
     *
     * @param  int $media_id
     * @return array response
     *         array response['location'] || response['error']
     *         int   response['status']
     **/
    public function validateMedia($media_id)
    {
        if (!empty((int) $media_id)) {
            $instagram = $this->instagram->getMedia($media_id);
            if (!empty($instagram)) {
                if (empty($instagram->meta->error_type)) {
                    $response = array(
                        'location' => $instagram->data->location,
                        'status' => 200
                    );
                } else {
                    $response = array(
                        'error' => array(
                            'error' => $instagram->meta->error_type,
                            'message' => $instagram->meta->error_message
                        ),
                        'status' => 409
                    );
                }
            } else {
                $response = array(
                    'error' => array(
                        'error' => self::DATA_NULL,
                        'message' => self::DATA_NULL_MESSAGE
                    ),
                    'status' => 409
                );
            }
        } else {
            $response = array(
                'error' => array(
                    'error' => self::ERROR_API,
                    'message' => self::ERROR_API_MESSAGE
                ),
                'status' => 409
            );
        }
        return $response;
    }
}
