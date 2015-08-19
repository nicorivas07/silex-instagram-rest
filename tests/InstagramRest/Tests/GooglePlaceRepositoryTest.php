<?php
/**
 * Test for GooglePlace Repository
 *
 * @author Nicolas Rivas <nicolasrivas07@gmail.com>
 */
use InstagramRest\Repository\GooglePlaceRepository;

class GooglePlaceRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Google API url
     */
    const API_URL = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json';

    /**
     * Google API key
     */
    const API_KEY = 'Your Google Place API KEY';

    /**
     * Test data null
     *
     * @return void
     */
    public function testDataNull()
    {
        $longitude = 'a';
        $latitude = 'b';

        $google_place = new GooglePlaceRepository(self::API_URL, self::API_KEY);
        $response = $google_place->get($latitude, $longitude);
        $this->assertNull($response['reference']);
        $this->assertNull($response['address']);
    }

    /**
     * Test data success
     *
     * @return void
     */
    public function testDataSuccess()
    {
        $latitude = 36.104980522;
        $longitude = -115.178432177;

        $google_place = new GooglePlaceRepository(self::API_URL, self::API_KEY);
        $response = $google_place->get($latitude, $longitude);
        $this->assertTrue(is_string($response['reference']));
        $this->assertTrue(is_string($response['address']));
    }


}