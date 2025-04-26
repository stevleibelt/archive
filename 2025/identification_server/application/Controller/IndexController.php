<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-20 
 */

namespace Controller;

/**
 * Class IndexController
 * @package Controller
 */
class IndexController extends AbstractController
{
    /**
     * @return array
     */
    public function index()
    {
        return $this->getResponse(
            array(
                'available routes' => array(
                    'identify'  => 'main service to validate provided name and password combination',
                    'identity'  => 'manage identities (create, read, update, delete data record)',
                    //'service'   => 'manage services (create, read, update, delete data record)',
                    //'user'      => 'manage users (create, read, update, delete data record)',
                )
            )
        )->toArray();
    }
} 