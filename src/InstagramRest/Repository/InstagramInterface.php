<?php
namespace InstagramRest\Repository;

/**
 * InstagramInterface
 *
 */
interface InstagramInterface
{
    /**
     * validateMedia
     *
     * @param  mixed $media_id
     * @return void
     **/
    public function validateMedia($media_id);
}