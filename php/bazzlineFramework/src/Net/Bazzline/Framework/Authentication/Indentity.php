<?php

namespace Net\Bazzline\Framework\Authentication;

/**
 * @author stev leibelt
 * @since 2013-03-18
 */
class Identity
{
    /**
     * @author stev leibelt
     * @since 2013-03-19
     * @var string 
     */
    private $loginname;

    /**
     * @author stev leibelt
     * @since 2013-03-19
     * @var mixed 
     */
    private $id;

    /**
     * @author stev leibelt
     * @param string $loginname
     * @since 2013-03-18
     */
    public function setLoginname($loginname)
    {
        $this->loginname = (string) $loginname;
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-03-18
     */
    public function getLoginname()
    {
        return $this->loginname;
    }
}