<?php

namespace Net\Bazzline\Framework\Template;

/**
 * @author stev leibelt
 * @since 2013-02-19
 */
interface TemplateInterface
{
    /**
     * @author stev leibelt
     * @param string $name
     * @since 2013-02-19
     */
    public function getValue($name);

    /**
     * @author stev leibelt
     * @param string $name
     * @param mixed $value
     * @since 2013-02-19
     */
    public function setValue($name, $value);

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-02-13
     */
    public function getTemplatePath();

    /**
     * @author stev leibelt
     * @param string $templatePath
     * @since 2013-02-19
     */
    public function setTemplatePath($templatePath);
}