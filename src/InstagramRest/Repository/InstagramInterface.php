<?php

namespace InstagramRest\Repository;

/**
 * InstagramInterface
 *
 */
interface InstagramInterface
{
    /**
     * GetMedia
     *
     * @param mixed $media_id
     * @return void
     */
    public function getMedia($media_id);
}