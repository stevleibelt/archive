<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-02-22 
 */

namespace Controller;

use Luracast\Restler\RestException;

/**
 * Class IdentifyController
 * @package Controller
 */
class IdentifyController extends AbstractController
{
    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2014-02-22
     */
    public function get($name = '', $password = '')
    {
        try {
            $this->validateString($name);
            $this->validateString($password);

            $query = $this->getDatabaseQuery();
            $query->setName($name);
            $query->setPassword($password);

            $database = $this->locator->getDatabase();
            $database->validateAuthorization($query);
            $response = $this->getResponse(array())->toArray();
        } catch (\InvalidArgumentException $exception) {
            throw new RestException(401, 'no or invalid arguments provided');
        } catch (\Exception $exception) {
            throw new RestException(500, 'something unexpected happened');
        }

        return $response;
    }
} 
