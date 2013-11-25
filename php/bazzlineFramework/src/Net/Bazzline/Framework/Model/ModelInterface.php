<?php

namespace Net\Bazzline\Framework\Model;

/**
 * @author stev leibelt
 * @since 2013-02-20
 */
interface ModelInterface
{
    /**
     * @author stev leibelt
     * @param mixed
     * @since 2013-02-20
     */
    public function setId($id);

    /**
     * @author stev leibelt
     * @return mixed
     * @since 2013-02-20
     */
    public function getId();

    /**
     * @author stev leibelt
     * @return boolean
     * @since 2013-02-20
     */
    public function hasId();

    /**
     * @author stev leibelt
     * @since 2013-02-20
     */
    public function resetId();
}
