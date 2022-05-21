<?php

namespace Net\Bazzline\Framework\Configuration;

/**
 * @author stev leibelt
 * @since 2013-02-20
 */
interface ConfigurationAwareInterface
{
    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Configuration\Configuration $configuration
     * @since 2013-02-20
     */
    public function getConfiguration();

    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Configuration\ConfiguationInterface $configuration
     * @since 2013-02-18
     */
    public function setConfiguration(Configuration $configuration);
}