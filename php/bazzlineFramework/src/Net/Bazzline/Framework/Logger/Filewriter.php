<?php

namespace Net\Bazzline\Framework\Logger;

/**
 * @author stev leibelt
 * @since 2013-03-12
 * @todo add loglevel to file content and change way of writing to "not output
 *  per loglevel"
 */
class Filewriter extends WriterAbstract
{
    /**
     * @author stev leibelt
     * @since 2013-03-14
     */
    public function append()
    {
        foreach ($this->getMessagesPerLoglevel() as $loglevel => $messages) {
            if ($this->getFilter()->accept($loglevel)) {
                foreach ($messages as $message) {
                    file_put_contents($this->getFilepath(), PHP_EOL . $message, FILE_APPEND);
                }
            }
        }
    }

    /**
     * @author stev leibelt
     * @since 2013-03-14
     */
    public function write()
    {
        foreach ($this->getMessagesPerLoglevel() as $loglevel => $messages) {
            if ($this->getFilter()->accept($loglevel)) {
                foreach ($messages as $message) {
                    file_put_contents($this->getFilepath(), $message);
                }
            }
        }
    }
    /**
     * @author stev leibelt
     * @return boolean
     * @since 2013-03-14
     */
    public function exists()
    {
        return file_exists($this->getFilepath());
    }

    /**
     * @author stev leibelt
     * @return boolean
     * @since 2013-03-13
     */
    public function overwrite()
    {
        if ($this->fileExists()) {
            unlink($this->filepath);
        }

        return $this->write();
    }
}