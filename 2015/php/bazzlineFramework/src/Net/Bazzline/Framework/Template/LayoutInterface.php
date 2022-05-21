<?php

namespace Net\Bazzline\Framework\Template;

/**
 * @author stev leibelt
 * @since 2013-02-19
 */
interface LayoutInterface extends RenderInterface, TemplateInterface
{
    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Template\ViewInterface $view
     * @since 2013-02-19
     */
    public function addView(ViewInterface $view);

    /**
     * @author stev leibelt
     * @since 2013-02-19
     */
    public function enableLayout();

    /**
     * @author stev leibelt
     * @since 2013-02-19
     */
    public function disableLayout();
}