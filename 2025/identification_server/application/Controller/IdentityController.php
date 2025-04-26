<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-20 
 */

namespace Controller;

use Model\Identity;
use Exception;
use InvalidArgumentException;
use Luracast\Restler\RestException;

/**
 * Class IdentityController
 * @package Controller
 */
class IdentityController extends AbstractController
{
    public function index()
    {
        //@todo get it work
        return $this->getResponse(array('you have to provide a valid name and password combination'))->toArray();
    }

    /**
     * @param string $name
     * @param string $password
     * @return array
     * @throws \Luracast\Restler\RestException
     */
    public function get($name = '', $password = '')
    {
        $response = null;

        try {
            $this->validateString($name);
            $this->validateString($password);

            $query = $this->getDatabaseQuery();
            $query->setName($name);
            $query->setPassword($password);

            $database = $this->locator->getDatabase();
            $database->validateAuthorization($query);
            $identity = $database->getIdentity($query);
            if ($identity instanceof Identity) {
                $response = $this->getResponse($identity->toArray());
            }
        } catch (\InvalidArgumentException $exception) {
            throw new RestException(401, 'no or invalid arguments provided');
        } catch (\Exception $exception) {
            throw new RestException(500, 'something unexpected happened');
        }

        return $response->toArray();
    }

    /**
     * @param string $name
     * @param string $password
     * @param string $validUntil
     * @return array
     * @throws \Luracast\Restler\RestException
     * @todo - work in progress
     */
    public function put($name = '', $password = '', $validUntil = '')
    {
        $response = null;

        try {
            $this->validateString($name);
            $this->validateString($password);

            $query = $this->getDatabaseQuery();
            $query->setName($name);
            $query->setPassword($password);

            $database = $this->locator->getDatabase();

            //@token -  check if no entry exists for this name
            //          create identity
            //          set valid until (set by user or by system?)
            $database->validateAuthorization($query);
            $identity = $database->getIdentity($query);
            $identity->setValidUntil($validUntil);
            if ($identity instanceof Identity) {
                $response = $this->getResponse($identity->toArray());
            }
        } catch (\InvalidArgumentException $exception) {
            throw new RestException(401, 'no or invalid arguments provided');
        } catch (\Exception $exception) {
            throw new RestException(500, 'something unexpected happened');
        }

        return $response->toArray();
    }

    public function post($name = '', $password = '', $validUntil = '')
    {

    }

    public function delete($name = '', $password = '')
    {

    }
} 