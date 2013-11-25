<?php

namespace Net\Bazzline\Framework\Service;

use Net\Bazzline\Framework\Authentication\Authenticate;
use InvalidArgumentException;

/**
 * @author stev leibelt
 * @since 2013-03-16
 */
class AuthenticateFactoryService extends ServiceFactoryAbstract
{
    /**
     * @author stev leibelt
     * @since 2013-03-16
     * @var integer
     */
    const CLASSNAME_STORAGE = 0;

    /**
     * @author stev leibelt
     * @since 2013-03-16
     * @var integer
     */
    const CLASSNAME_IDENTITY = 1;

    /**
     * @author stev leibelt
     * @since 2013-03-16
     * @var integer
     */
    const CLASSNAME_CREDENTIAL = 2;

    /**
     * @author stev leibelt
     * @since 2013-03-16
     * @var integer
     */
    const IDENTITY_LOGINNAME = 3;

    /**
     * @author stev leibelt
     * @since 2013-03-16
     * @var integer
     */
    const CREDENTIAL_PASSPHRASE = 4;

    /**
     * @author stev leibelt
     * @since 2013-03-16
     * @var integer
     */
    const CREDENTIAL_SALT = 5;

    /**
     * @author stev leibelt
     * @param array $data
     * @return \Net\Bazzline\Framework\Authentication\AuthenticateInterface
     * @since 2013-03-16
     * @throws \InvalidArgumentException
     */
    public static function create(array $data = array())
    {
        self::validateData($data);

        $authenticate = new Authenticate();
        $credential = new $data[self::CLASSNAME_CREDENTIAL]();
        $indentity = new $data[self::CLASSNAME_IDENTITY]();
        $storage = new $data[self::CLASSNAME_STORAGE]();

        if (isset($data[self::IDENTITY_LOGINNAME])) {
            $indentity->setLoginname($data[self::IDENTITY_LOGINNAME]);
        }
        if (isset($data[self::CREDENTIAL_PASSPHRASE])) {
            $credential->setPassphrase($data[self::CREDENTIAL_PASSPHRASE]);
        }
        if (isset($data[self::CREDENTIAL_SALT])) {
            $credential->setSalt($data[self::CREDENTIAL_SALT]);
        }

        $authenticate->setCredential($credential);
        $authenticate->setIdentity($indentity);
        $authenticate->setStorage($storage);

        return $authenticate;
    }

    /**
     * @author stev leibelt
     * @param array $data
     * @throws \InvalidArgumentException
     * @since 2013-03-16
     */
    private static function validateData(array $data)
    {
        $mandatoryDataKeys = array(
            self::CLASSNAME_STORAGE,
            self::CLASSNAME_IDENTITY,
            self::CLASSNAME_CREDENTIAL
        );

        foreach ($mandatoryDataKeys as $mandatoryDataKey) {
            if (!isset($data[$mandatoryDataKey])) {
                $message = 'Mandatory datakey "' . $mandatoryDataKey . 
                    '" not set';

                throw new InvalidArgumentException($message);
            }
        }
    }
}