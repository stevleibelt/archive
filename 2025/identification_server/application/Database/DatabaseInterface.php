<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-03-26
 */

namespace Database;

use Model\Hasher;
use Model\Identity;
use Service\Factory\IdentityFactory;

/**
 * Interface DatabaseInterface
 * @package Database
 */
interface DatabaseInterface
{
    /**
     * @param Query $query
     * @throws \InvalidArgumentException
     */
    public function validateAuthorization(Query $query);

    /**
     * @param Hasher $hasher
     */
    public function setHasher(Hasher $hasher);

    /**
     * @param IdentityFactory $factory
     */
    public function setIdentityFactory(IdentityFactory $factory);

    /**
     * @param Query $query
     * @return null|Identity
     */
    public function getIdentity(Query $query);
}
