<?php

namespace Net\Bazzline\Framework\Model;

use Exception;

/**
 * @author stev leibelt
 * @since 2013-02-20
 */
class Model implements ModelInterface
{
    /**
     * @author stev leibelt
     * @since 2013-02-20
     * @var mixed
     */
    private $id;

    /**
     * @author stev leibelt
     * @param mixed
     * @since 2013-02-20
     */
    public function setId($id)
    {
        if (!is_null($this->id)) {
            $message = 'Id already set.';

            throw new Exception($message);
        }

        $this->id = $id;
    }

    /**
     * @author stev leibelt
     * @return mixed
     * @since 2013-02-20
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @author stev leibelt
     * @return boolean
     * @since 2013-02-20
     */
    public function hasId()
    {
        return (!is_null($this->getId()));
    }

    /**
     * @author stev leibelt
     * @since 2013-02-20
     */
    public function resetId()
    {
        $this->id = null;
    }
}