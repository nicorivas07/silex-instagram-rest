<?php
/**
 * Controller for Instagram resource
 *
 * @author Nicolas Rivas <nicolasrivas07@gmail.com>
 */
namespace InstagramRest\Controller;

use Silex\Application;
use InstagramRest\Repository\InstagramRepository;

class InstagramController
{
    /**
     * InstagramRest\Repository\InstagramRepository
     *
     * @var Instagram
     */
    protected $instagram;

    /**
     * Constructor of the class
     *
     * @param InstagramRepository $instagram
     */
    public function __construct(InstagramRepository $instagram)
    {
        $this->instagram = $instagram;
    }

    /**
     * index display media location data
     *
     * @param  int $media_id
     * @param  Application $app
     * @return array $response
     */
    public function indexAction($media_id, Application $app) {
        return $app->json($this->instagram->validateMedia($media_id));
    }
}