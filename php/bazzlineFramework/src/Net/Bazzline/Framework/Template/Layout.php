<?php

namespace Net\Bazzline\Framework\Template;

/**
 * @author stev leibelt
 * @since 2013-02-19
 */
class Layout extends Template implements LayoutInterface
{
    /**
     * @author stev leibelt
     * @since 2013-02-19
     * @var boolean
     */
    private $isLayoutEnabled;

    /**
     * @author stev leibelt
     * @since 2013-02-19
     * @var array
     */
    private $views;

    /**
     * @author stev leibelt
     * @since 2013-02-19
     */
    public function __construct()
    {
        parent::__construct();
        $this->enableLayout();
        $this->views = array();
    }

    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Template\ViewInterface $view
     * @since 2013-02-19
     */
    public function addView(ViewInterface $view)
    {
        $this->views[] = $view;
    }

    /**
     * @author stev leibelt
     * @since 2013-02-19
     */
    public function enableLayout()
    {
        $this->isLayoutEnabled = true;
    }

    /**
     * @author stev leibelt
     * @since 2013-02-19
     */
    public function disableLayout()
    {
        $this->isLayoutEnabled = false;
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-02-19
     */
    public function render()
    {
        $content = '';

        foreach ($this->views as $view) {
            $content .= $view->render();
        }

        if ($this->isLayoutEnabled
            && file_exists($this->getTemplatePath())) {
            ob_start();
            include $this->getTemplatePath();
            $content .= ob_get_clean();
        }

        return (string) $content;
    }
}