<?php

namespace AppName\Entity;

/**
 * Default class description
 *
 * @author Nicolas Rivas <nicolasrivas07@gmail.com>
 */
class Default implements DefaultInterface
{
    /**
     * User id.
     *
     * @var integer
     */
    protected $id;

    /**
     * getId description
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * setId description
     *
     * @param int $id
     * @return int $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this->id;
    }
}
