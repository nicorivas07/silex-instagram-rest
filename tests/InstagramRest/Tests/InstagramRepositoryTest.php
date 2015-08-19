<?php
/**
 * Test for Instagram Repository
 *
 * @author Nicolas Rivas <nicolasrivas07@gmail.com>
 */
use InstagramRest\Repository\InstagramRepository;

class InstagramRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Instagram client_id
     */
    const CLIENT_ID = 'Your Instagram Client ID';

    /**
     * Test Wrong media_id.
     *
     * @return void
     */
    public function testWrongMediaId()
    {
        $instagram = new InstagramRepository(self::CLIENT_ID);
        $response = $instagram->validateMedia('as');
        $expected = array(
            'error' => array(
                'error' => InstagramRepository::ERROR_API,
                'message' => InstagramRepository::ERROR_API_MESSAGE
            ),
            'status' => 409
        );
        $this->assertEquals($response, $expected);
    }

    /**
     * Test data success.
     *
     * @return void
     */
    public function testSuccess()
    {
        $instagram = new InstagramRepository(self::CLIENT_ID);
        $response = $instagram->validateMedia('914837609611565028');
        $this->assertArrayHasKey('location', $response);
    }
}