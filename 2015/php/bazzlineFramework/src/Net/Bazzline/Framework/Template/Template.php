<?php

namespace Net\Bazzline\Framework\Template;

class Template implements TemplateInterface
{
    /**
     * @author stev leibelt
     * @since 2013-02-19
     * @var string
     */
    private $data;

    /**
     * @author stev leibelt
     * @var since 2013-02-19
     */
    private $templatePath;

    /**
     * @author stev leibelt
     * @since 2013-02-19
     */
    public function __construct()
    {
        $this->data = array();
        $this->templatePath = '';
    }

    /**
     * @author stev leibelt
     * @param string $name
     * @return mixed
     * @since 2013-02-19
     */
    public function __get($name)
    {
        return (array_key_exists((string) $name, $this->data)) ?
            $this->data[(string) $name] : null;
    }

    /**
     * @author stev leibelt
     * @param string $name
     * @return mixed
     * @since 2013-02-19
     */
    public function getValue($name)
    {
        return (array_key_exists((string) $name, $this->data)) ?
            $this->data[(string) $name] : null;
    }

    /**
     * @author stev leibelt
     * @param mixed $name
     * @param mixed $value
     * @since 2013-02-19
     */
    public function setValue($name, $value)
    {
        $this->data[(string) $name] = $value;
    }

    /**
     * @author stev leibelt
     * @param string $templatePath
     * @since 2013-02-19
     */
    public function setTemplatePath($templatePath)
    {
        $this->templatePath = (string) $templatePath;
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-02-13
     */
    public function getTemplatePath()
    {
        return $this->templatePath;
    }

    /**
     * @author stev leibelt
     * @param array $data
     * @since 2013-02-19
     */
    protected function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @author stev leibelt
     * @return array
     * @since 2013-02-19
     */
    protected function getData()
    {
        return $this->data;
    }
}