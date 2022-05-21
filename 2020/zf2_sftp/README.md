# SFTP Module for ZF2

## Code ideas

```php
<?php
/**
 * used:
 *  http://phpseclib.sourceforge.net/sftp/examples.html#list
 *  https://packagist.org/packages/phpseclib/phpseclib
 *  https://github.com/phpseclib/phpseclib
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-05-21
 */

namespace Net\Bazzline\ZF2\Module\SFTP;

use Net_SFTP;

/**
 * Class SFTP
 *
 * @package Inhouse\SFTP
 */
class SFTP
{
    /** @var Net_SFTP */
    private $connection;

    /** @var string */
    private $host;

    /** @var string */
    private $password;

    /** @var int */
    private $port;

    /** @var string */
    private $username;

    /**
     * @param string $host
     * @param int $port
     * @param string $username
     * @param string $password
     */
    public function __construct($host, $port, $username, $password)
    {
        $this->host = '127.0.0.1';
        $this->password = $password;
        $this->port = 22;
        $this->username = $username;
    }

    /**
     * @throws ConnectionFailedException
     */
    public function connect()
    {
        $this->connection = new Net_SFTP($this->host, $this->port);

        if (!$this->connection->login($this->username, $this->password)) {
            $this->connection = null;
            throw new ConnectionFailedException('login failed');
        }
    }

    /**
     * @param string $path
     */
    public function cd($path)
    {
        $this->connection->chdir($path);
    }

    /**
     * @param string $path
     * @param bool $listDetailed
     * @return array
     */
    public function ls($path = '.', $listDetailed = false)
    {
        if ($listDetailed) {
            $result = $this->connection->rawlist($path);
            $list = array_filter($result, function() use (&$result) {
                $directoryName = (key($result));

                if (in_array($directoryName, array('.', '..'))) {
                    $keepValue = false;
                } else {
                    $keepValue = true;
                }

                return $keepValue;
            });
        } else {
            $result = $this->connection->nlist($path);
            $list = array_filter($result, function($directoryName) {
                if (in_array($directoryName, array('.', '..'))) {
                    $keepValue = false;
                } else {
                    $keepValue = true;
                }

                return $keepValue;
            });
        }

        return $list;
    }

    public function put()
    {

    }

    public function delete()
    {

    }
}
```
