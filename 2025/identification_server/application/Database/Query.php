<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-03-26
 */

namespace Database;

/**
 * Class Query
 * @package Database
 */
class Query
{
    /** @var int|string */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $password;

    /**
     * @param int|string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function hasId()
    {
        return (!is_null($this->id));
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return bool
     */
    public function hasName()
    {
        return (!is_null($this->name));
    }

    /**
     * @return bool
     */
    public function hasPassword()
    {
        return (!is_null($this->password));
    }

    /**
     * @param string $value
     */
    public function setName($value)
    {
        $this->name = trim($value);
    }

    /**
     * @param string $value
     */
    public function setPassword($value)
    {
        $this->password = trim($value);
    }
}
