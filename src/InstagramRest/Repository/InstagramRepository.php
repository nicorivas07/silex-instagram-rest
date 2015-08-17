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
     * @var MetzWeb\Instagram\Instagram
     */
    protected $instagram;

    /**
     * Constructor of the class
     */
    public function __construct()
    {
        $instagram = new Instagram('4edf05a5083e43e6b8a684ce8912205f');

        $this->instagram = $instagram;
    }

    /**
     * Get
     *
     * @param int $media_id
     * @return Instagram
     */
    public function getMedia($media_id)
    {
        return $this->instagram->getMedia($media_id);
    }

}
