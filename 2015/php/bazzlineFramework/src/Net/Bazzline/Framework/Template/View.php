<?php

namespace Net\Bazzline\Framework\Template;

/**
 * @author stev leibelt
 * @since 2013-02-19
 */
class View extends Template implements ViewInterface
{
    /**
     * @author stev leibelt
     * @param mixed array | Net\Bazzline\Framework\Template $data
     * @since 2013-02-19
     */
    public function __construct($data = array())
    {
        if ($data instanceof Template) {
            $this->setData($data);
        } else if (is_array($data)) {
            $this->setData($data);
        }
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-02-19
     */
    public function render()
    {
        $content = '';
        if (file_exists($this->getTemplatePath())) {
            ob_start();
            include $this->getTemplatePath();
            $content .= ob_get_clean();
        }

        return (string) $content;
    }
}