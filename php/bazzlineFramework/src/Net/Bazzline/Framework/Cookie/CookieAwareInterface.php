<?php

namespace Net\Bazzline\Framework\Cookie;

/**
 * @author stev leibelt
 * @since 2013-03-24
 */
interface CookieAwareInterface
{
    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Cookie\Cookie $cookie
     * @since 2013-03-24
     */
    public function setCookie(Cookie $cookie);

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Cookie\Cookie
     * @since 2013-03-24
     */
    public function getCookie();
}