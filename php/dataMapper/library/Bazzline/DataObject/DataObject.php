<?php

namespace Bazzline;

/**
 * General data object class.
 * This class defines methods needs to work with data mapper.
 * 
 * @author stev leibelt
 * @since 2012-09-09
 */
class DataObject
{
    /** @var mixed*/
    private $id;

    /** @var boolean */
    private $isModified;

    /**
     * Returns if id is set
     * 
     * @author stev leibelt
     * @return boolean
     * @since 2012-09-09
     */
    public function hasId()
    {
        return (!is_null($this->id));
    }

    /**
     * Sets the id
     * 
     * @author stev leibelt
     * @param mixed $id
     * @throws Exception
     * @since 2012-09-09
     */
    public function setId($id)
    {
        if ($this->hasId()) {
            throw new Exception('id already set');
        } else {
            $this->id = $id;
        }
    }

    /**
     * Unsets the id
     * 
     * @author sleibelt
     * @since 2012-09-09
     */
    public function unsetId()
    {
        $this->id = null;
    }

    /**
     * Check if data object properties where changed
     * 
     * @author stev leibelt
     * @return boolean
     * @since 2012-09-09
     */
    public function isModified()
    {
        return $this->isModified;
    }
}
