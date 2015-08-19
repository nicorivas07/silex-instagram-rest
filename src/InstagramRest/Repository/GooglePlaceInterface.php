<?php
namespace InstagramRest\Repository;

/**
 * GooglePlaceInterface
 */
interface GooglePlaceInterface
{
    /**
     * Get
     *
     * @param mixed $latitude
     * @param mixed $longitude
     * @return void
     */
    public function get($latitude, $longitude);
}